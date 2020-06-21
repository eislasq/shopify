const CartLoadCart = wp.element.lazy(() =>
  import(
    /* webpackChunkName: 'AdminSettingCartLoadCart-admin' */ "../../../../app/settings/cart/cart-load-cart"
  )
)

const CartShowFixedCartTab = wp.element.lazy(() =>
  import(
    /* webpackChunkName: 'AdminSettingCartShowFixedCartTab-admin' */ "../../../../app/settings/cart/cart-show-fixed-cart-tab"
  )
)

const CheckoutButtonTarget = wp.element.lazy(() =>
  import(
    /* webpackChunkName: 'AdminSettingCheckoutButtonTarget-admin' */ "../../../../app/settings/checkout/checkout-button-target"
  )
)
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
