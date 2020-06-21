/** @jsx jsx */
import { jsx, css } from "@emotion/core"
import Text from "../../../../app/admin/text"
import WizardContext from "../../../_state/context"

function ConnectionHeader({ title }) {
  const { Button } = wp.components
  const { useContext } = wp.element
  const [wizardState, wizardDispatch] = useContext(WizardContext)

  const openModal = () =>
    wizardDispatch({ type: "SET_ACTIVE_MODAL", payload: "connection" })

  return (
    <>
      <Text variant="title.large" as="h1">
        {title}
      </Text>
      <Text variant="body.large">
        {wp.i18n.__("Find your Shopify API keys by ", "wpshopify")}
        <Button isLink onClick={openModal}>
          {wp.i18n.__("watching our short video tutorial", "wpshopify")}
        </Button>
      </Text>
    </>
  )
}

export default ConnectionHeader
