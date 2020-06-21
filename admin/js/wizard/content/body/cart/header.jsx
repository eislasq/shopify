/** @jsx jsx */
import { jsx, css } from "@emotion/core"
import Text from "../../../../app/admin/text"

function CartHeader({ title }) {
  return (
    <>
      <Text variant="title.large" as="h1">
        {title}
      </Text>
      <Text variant="body.large">
        {wp.i18n.__(
          "These are just defaults. You can change them at anytime.",
          "wpshopify"
        )}
      </Text>
    </>
  )
}

export default CartHeader
