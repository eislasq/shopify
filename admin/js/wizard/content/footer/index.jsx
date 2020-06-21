import Row from "../../../app/admin/row"
import Modals from "../modals"
import { buttonCSS } from "../../_common/css"
import {
  saveSettings,
  saveConnection,
} from "../../../app/settings/_common/save-settings"
import {
  findEmptyConnectionValues,
  hasFalseyValues,
} from "../../../app/settings/_common/utils"
import SettingsContext from "../../../app/settings/_state/context"
import {
  fetchMaskedConnection,
  getShopCache,
} from "/Users/andrew/www/devil/devilbox-new/data/www/wpshopify-api"

/** @jsx jsx */
import { jsx, css } from "@emotion/core"
import WizardContext from "../../_state/context"
import to from "await-to-js"

function WizardFooter() {
  const { Button, Notice } = wp.components
  const { useContext, useEffect, useRef } = wp.element
  const [wizardState, wizardDispatch] = useContext(WizardContext)
  const [settingsState, settingsDispatch] = useContext(SettingsContext)
  const nextButton = useRef()

  const busyCSS = css`
    &:hover {
      cursor: ${wizardState.isBusy ? "wait" : "pointer"};
    }
  `
  const WizardFooterCSS = css`
    margin-top: 2em;
    position: relative;
    z-index: 1;
  `

  const PrevStepCSS = css`
    && {
      position: absolute;
      left: 0;
      padding-left: 150px;
      opacity: ${wizardState.isBusy ? 0.4 : 1};

      &:focus,
      &:active {
        outline: none;
        border: none;
        box-shadow: none;
        background: none;
      }

      &:hover {
        cursor: ${wizardState.isBusy ? "wait" : "pointer"};
      }
    }
  `

  const skipCSS = css`
    opacity: ${wizardState.isBusy ? 0.4 : 1};

    &:hover {
      cursor: ${wizardState.isBusy ? "wait" : "pointer"};
    }
  `

  async function getExistingConnectionValues() {
    const [error, resp] = await to(fetchMaskedConnection())

    if (error) {
      wizardDispatch({
        type: "SET_ERROR",
        payload: wp.i18n.__(
          'Uh oh, an error occured while attempting to fetch an existing connection. Go to the plugin settings and verify that you have an active connection under the "Connect" tab.',
          "wpshopify"
        ),
      })

      wizardDispatch({
        type: "SET_IS_LOADING_CONNECTION",
        payload: false,
      })

      return
    }

    const shop = getShopCache()

    if (shop) {
      wizardDispatch({
        type: "SET_STORE_NAME",
        payload: shop.name,
      })
    }

    wizardDispatch({
      type: "SET_EXISTING_CONNECTION_VALUES",
      payload: {
        apiKey: resp.data.api_key,
        apiPassword: resp.data.api_password,
        sharedSecret: resp.data.shared_secret,
        storefrontAccessToken: resp.data.storefront_access_token,
        domain: resp.data.domain,
      },
    })

    wizardDispatch({
      type: "SET_IS_LOADING_CONNECTION",
      payload: false,
    })

    wizardDispatch({ type: "SET_CONNECTION", payload: true })
  }

  useEffect(() => {
    if (wpshopify.settings.syncing.hasConnection) {
      getExistingConnectionValues()
    } else {
      wizardDispatch({
        type: "SET_IS_LOADING_CONNECTION",
        payload: false,
      })
    }
  }, [wizardDispatch])

  function onKeyPress() {
    if (event.key === "Enter") {
      onNextStep()
    }
  }

  async function onNextStep(e) {
    nextButton.current.blur()

    if (wizardState.error) {
      window.location.href =
        wpshopify.misc.adminURL +
        "admin.php?page=wps-connect&wpshopify-finished-wizard=true"
      return
    }

    if (
      wizardState.activeStep === 1 &&
      !wpshopify.settings.syncing.hasConnection
    ) {
      settingsDispatch({
        type: "UPDATE_CONNECTION_ERRORS",
        payload: [],
      })

      if (hasFalseyValues(settingsState.connection)) {
        settingsDispatch({
          type: "UPDATE_CONNECTION_ERRORS",
          payload: findEmptyConnectionValues(settingsState.connection),
        })

        return
      }

      var [saveConnectionError, saveConnectionData] = await to(
        saveConnection(settingsState.connection, wizardDispatch)
      )

      if (saveConnectionError) {
        settingsDispatch({
          type: "UPDATE_CONNECTION_ERRORS",
          payload: [saveConnectionError],
        })

        return
      }

      wizardDispatch({
        type: "SET_STORE_NAME",
        payload: saveConnectionData.data.name,
      })

      wizardDispatch({ type: "SET_CONNECTION", payload: true })
    }

    if (wizardState.activeStep === 3) {
      settingsDispatch({
        type: "UPDATE_SETTING",
        payload: { key: "wizardCompleted", value: true },
      })
    }

    if (wizardState.activeStep === 4) {
      const [err, succ] = await to(saveSettings(settingsState, wizardDispatch))

      if (err) {
        wizardDispatch({
          type: "SET_ERROR",
          payload: err,
        })
        return
      }

      wizardDispatch({ type: "SET_IS_FINISHED", payload: true })
    }

    wizardDispatch({
      type: "UPDATE_COMPLETED_STEPS",
      payload: {
        operation: "add",
        step: wizardState.activeStep,
      },
    })

    wizardDispatch({
      type: "SET_ACTIVE_STEP",
      payload: wizardState.activeStep + 1,
    })
  }

  function onPrevStep(e) {
    if (wizardState.isBusy || wizardState.activeStep === 1) {
      return
    }

    wizardDispatch({
      type: "SET_ACTIVE_STEP",
      payload: wizardState.activeStep - 1,
    })

    wizardDispatch({
      type: "UPDATE_COMPLETED_STEPS",
      payload: {
        operation: "remove",
        step: wizardState.activeStep - 1,
      },
    })
  }

  function onSkip() {
    if (wizardState.isBusy) {
      return
    }
  }

  function getButtonText() {
    if (wizardState.error) {
      return wp.i18n.__("Return to plugin settings", "wpshopify")
    }

    if (wizardState.isBusy && wizardState.activeStep === 1) {
      return wp.i18n.__("Connecting to Shopify ...", "wpshopify")
    }

    if (wizardState.isBusy && wizardState.activeStep === 4) {
      return wp.i18n.__("Finishing Setup ...", "wpshopify")
    }

    if (
      wizardState.activeStep === 1 &&
      !wpshopify.settings.syncing.hasConnection
    ) {
      return wp.i18n.__("Save Connection and Continue", "wpshopify")
    }

    if (
      wizardState.activeStep === 1 &&
      wpshopify.settings.syncing.hasConnection
    ) {
      return wp.i18n.__("Continue to Next Step", "wpshopify")
    }

    if (wizardState.activeStep === 4) {
      return wp.i18n.__("Save and Finish the Setup", "wpshopify")
    }
    return wp.i18n.__("Continue to Next Step", "wpshopify")
  }

  return (
    !wizardState.isFinished && (
      <>
        <Row align="center" customCSS={WizardFooterCSS}>
          {wizardState.activeStep !== 1 && (
            <Button isLink onClick={onPrevStep} css={PrevStepCSS}>
              {wp.i18n.__("Previous Step", "wpshopify")}
            </Button>
          )}

          <Button
            isPrimary
            isLarge
            onClick={onNextStep}
            onKeyPress={onKeyPress}
            css={[buttonCSS, busyCSS]}
            isBusy={wizardState.isBusy}
            disabled={wizardState.isBusy || wizardState.isLoadingConnection}
            ref={nextButton}
          >
            {getButtonText()}
          </Button>
        </Row>

        <Row align="center" customCSS={WizardFooterCSS}>
          <Button
            isLink
            onClick={onSkip}
            css={skipCSS}
            href={
              wpshopify.misc.adminURL +
              "admin.php?page=wps-settings&wpshopify-finished-wizard=true"
            }
          >
            {wp.i18n.__("Skip the setup process", "wpshopify")}
          </Button>
        </Row>

        {wizardState.activeModal && (
          <Modals activeModal={wizardState.activeModal} />
        )}
      </>
    )
  )
}

export default WizardFooter
