/** @jsx jsx */
import { jsx, css } from "@emotion/core"
import ModalWrapper from "./wrapper"
import ModalConnection from "./connection"

function Modals({ activeModal }) {
  return (
    activeModal === "connection" && (
      <ModalWrapper
        title={wp.i18n.__("Finding your Shopify API keys", "wpshopify")}
        shouldCloseOnClickOutside={false}
      >
        <ModalConnection />
      </ModalWrapper>
    )
  )
}

export default Modals
