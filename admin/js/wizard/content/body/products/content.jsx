import GeneralProductsPerPage from "../../../../app/settings/general/general-products-per-page"
import ProductsColorVariant from "../../../../app/settings/products/products-color-variant"
import ProductsColorAddToCart from "../../../../app/settings/products/products-color-add-to-cart"
import ProductsPlpDescriptionsToggle from "../../../../app/settings/products/products-plp-descriptions-toggle"

function ProductsContent() {
  const { Suspense } = wp.element
  const { CardBody, Spinner } = wp.components

  return (
    <CardBody className="wpshopify-wizard-content-products">
      <Suspense fallback={<Spinner />}>
        <GeneralProductsPerPage />
        <ProductsPlpDescriptionsToggle />
        <ProductsColorVariant />
        <ProductsColorAddToCart />
      </Suspense>
    </CardBody>
  )
}

export default ProductsContent
