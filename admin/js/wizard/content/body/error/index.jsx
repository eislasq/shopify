/** @jsx jsx */
import { jsx, css } from "@emotion/core"

function ErrorCallToAction() {
  const ErrorCallToAction = css`
    display: block;
    margin-top: 5px;
  `
  return (
    <a
      css={ErrorCallToAction}
      href={
        wpshopify.misc.adminURL +
        "admin.php?page=wps-settings&wpshopify-finished-wizard=true"
      }
    >
      {wp.i18n.__("Go to the plugin settings", "wpshopify")}
    </a>
  )
}

export default ErrorCallToAction
