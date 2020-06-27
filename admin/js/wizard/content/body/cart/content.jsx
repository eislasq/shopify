import CartLoadCart from "../../../../app/settings/cart/cart-load-cart"
import CartShowFixedCartTab from "../../../../app/settings/cart/cart-show-fixed-cart-tab"
import CheckoutButtonTarget from "../../../../app/settings/checkout/checkout-button-target"
import WizardContext from "../../../_state/context"

/** @jsx jsx */
import { jsx, css } from "@emotion/core"

function CartContent() {
  const { Suspense, useContext } = wp.element
  const { CardBody, Spinner } = wp.components
  const [wizardState] = useContext(WizardContext)

  const CartContentCSS = css`
    opacity: ${wizardState.isBusy ? 0.4 : 1};
  `
  return (
    <CardBody className="wpshopify-wizard-content-cart" css={CartContentCSS}>
      <Suspense fallback={<Spinner />}>
        <CartLoadCart />
        <CartShowFixedCartTab />
        <CheckoutButtonTarget />
      </Suspense>
    </CardBody>
  )
}

export default CartContent
