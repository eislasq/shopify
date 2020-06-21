import ConnectionHeader from "./connection/header"
import ConnectionContent from "./connection/content"
import GeneralHeader from "./general/header"
import GeneralContent from "./general/content"
import ProductsHeader from "./products/header"
import ProductsContent from "./products/content"
import CartHeader from "./cart/header"
import CartContent from "./cart/content"
import FinishedHeader from "./finished/header"
import ContentStep from "./step"

function WizardBody() {
  return (
    <>
      <ContentStep
        header={
          <ConnectionHeader
            title={wp.i18n.__(
              "Welcome! Let's start by connecting your Shopify store.",
              "wpshopify"
            )}
          />
        }
        content={<ConnectionContent />}
        step={1}
      />
      <ContentStep
        header={
          <GeneralHeader
            title={wp.i18n.__(
              "Awesome. Now we'll set some general settings.",
              "wpshopify"
            )}
          />
        }
        content={<GeneralContent />}
        step={2}
      />
      <ContentStep
        header={
          <ProductsHeader
            title={wp.i18n.__(
              "You're on a roll! Let's configure your products.",
              "wpshopify"
            )}
          />
        }
        content={<ProductsContent />}
        step={3}
      />
      <ContentStep
        header={
          <CartHeader
            title={wp.i18n.__(
              "Ok almost done. We'll finish with your cart.",
              "wpshopify"
            )}
          />
        }
        content={<CartContent />}
        step={4}
      />
      <ContentStep
        header={
          <FinishedHeader
            title={wp.i18n.__(
              "Wahoo! You're ready to start selling!",
              "wpshopify"
            )}
          />
        }
        step={5}
      />
    </>
  )
}

export default WizardBody
