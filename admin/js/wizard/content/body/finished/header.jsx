/** @jsx jsx */
import { jsx, css } from "@emotion/core"
import Text from "../../../../app/admin/text"
import Row from "../../../../app/admin/row"
import { AdminContext } from "../../../../app/admin/_state/context"
import SettingsContext from "../../../../app/settings/_state/context"
import { buttonCSS } from "../../../_common/css"
import { IconSuccess } from "../../../_common/icons"

function findProductsURL(availablePages, pageID) {
  pageID = parseInt(pageID)
  var found = availablePages.filter((page) => page.ID === pageID)

  if (found.length) {
    return found[0].guid
  }

  return false
}

function FinishedHeader({ title }) {
  const { useContext, useState } = wp.element
  const { Button, Dashicon } = wp.components
  const [settingsState] = useContext(SettingsContext)
  const [adminState] = useContext(AdminContext)

  const [productsURL] = useState(
    findProductsURL(adminState.availablePages, settingsState.pageProducts)
  )

  const successIconCSS = css`
    max-width: 150px;
    margin-top: -2em;
    height: auto;
  `

  const dashiconCSS = css`
    margin-left: 10px;
  `

  const linkCSS = css`
    && {
      font-size: 16px;
      padding: 20px 20px 20px 0;
      border-radius: 8px;
      margin-left: 10px;
      text-decoration: none;

      p {
        margin: 0;
      }

      svg {
        margin-left: 6px;
        margin-top: -3px;
      }
    }
  `

  const bodyCSS = css`
    max-width: 515px;
    text-align: center;
    margin: 0 auto 4em auto;
    font-size: 16px;
  `

  const productsLinkCSS = css`
    background: white;
    width: auto;
    margin: 0 auto;
    border-radius: 5px;
    margin-bottom: 1em;
    padding: 0 0 0 30px;
    display: inline-block;

    .components-button:focus,
    .components-button:focus:not(:disabled) {
      box-shadow: none;
    }

    p {
      margin: 0;
    }
  `

  function onClick() {
    window.location.href =
      wpshopify.misc.adminURL + "admin.php?page=wps-settings"
  }

  return (
    <>
      <IconSuccess customCSS={successIconCSS} />
      <Text variant="title.large" as="h1">
        {title}
      </Text>
      {productsURL && (
        <div css={productsLinkCSS}>
          <Text variant="subtitle">
            <span>{wp.i18n.__("View your products here:", "wpshopify")}</span>
            <Button
              target="_blank"
              isLink
              isLarge
              href={productsURL}
              css={linkCSS}
            >
              {productsURL}
              <Dashicon icon="external" />
            </Button>
          </Text>
        </div>
      )}
      <div css={bodyCSS}>
        {settingsState.isSyncingPosts && (
          <Text variant="body.large">
            {wp.i18n.__(
              "If you want product detail pages, remember to manually sync these by using the ",
              "wpshopify"
            )}
            <a
              href={wpshopify.misc.adminURL + "admin.php?page=wps-tools"}
              target="_blank"
            >
              {wp.i18n.__(
                " Sync Product & Collection Detail Pages",
                "wpshopify"
              )}
            </a>
            {wp.i18n.__(" tool.", "wpshopify")}
          </Text>
        )}

        <Text variant="body.large">
          {wp.i18n.__(
            "Also, for additional display options try our ",
            "wpshopify"
          )}
          <a href="https://demo.wpshop.io/builder" target="_blank">
            {wp.i18n.__("visual builder", "wpshopify")}
          </a>
          !
        </Text>
      </div>
      <Row align="center">
        <Button css={buttonCSS} isPrimary isLarge onClick={onClick}>
          {wp.i18n.__("Back to WordPress Dashboard", "wpshopify")}
          <Dashicon css={dashiconCSS} icon="arrow-right-alt" />
        </Button>
      </Row>
    </>
  )
}

export default FinishedHeader
