import ApiKey from "../../../../app/settings/connection/api-key"
import ApiPassword from "../../../../app/settings/connection/api-password"
import Domain from "../../../../app/settings/connection/domain"
import SharedSecret from "../../../../app/settings/connection/shared-secret"
import StorefrontAccessToken from "../../../../app/settings/connection/storefront-access-token"
import WizardContext from "../../../_state/context"
/** @jsx jsx */
import { jsx, css } from "@emotion/core"

function ConnectionContent() {
  const { CardBody, Spinner } = wp.components
  const { useContext } = wp.element
  const [wizardState] = useContext(WizardContext)

  const existingConnectionCSS = css`
    text-align: center;
    display: block;
    margin-top: 15px;
  `

  return (
    <CardBody className="wpshopify-wizard-content-connection">
      {wizardState.isLoadingConnection ? (
        <>
          <Spinner />
          <p css={existingConnectionCSS}>
            {wp.i18n.__("Checking for existing connection ...", "wpshopify")}
          </p>
        </>
      ) : (
        <>
          <ApiKey
            existingValue={
              wizardState.existingConnectionValues
                ? wizardState.existingConnectionValues.apiKey
                : false
            }
            isBusy={wizardState.isBusy}
          />
          <ApiPassword
            existingValue={
              wizardState.existingConnectionValues
                ? wizardState.existingConnectionValues.apiPassword
                : false
            }
            isBusy={wizardState.isBusy}
          />
          <SharedSecret
            existingValue={
              wizardState.existingConnectionValues
                ? wizardState.existingConnectionValues.sharedSecret
                : false
            }
            isBusy={wizardState.isBusy}
          />
          <StorefrontAccessToken
            existingValue={
              wizardState.existingConnectionValues
                ? wizardState.existingConnectionValues.storefrontAccessToken
                : false
            }
            isBusy={wizardState.isBusy}
          />
          <Domain
            existingValue={
              wizardState.existingConnectionValues
                ? wizardState.existingConnectionValues.domain
                : false
            }
            isBusy={wizardState.isBusy}
          />
        </>
      )}
    </CardBody>
  )
}

export default ConnectionContent
