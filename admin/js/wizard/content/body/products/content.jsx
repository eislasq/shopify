const GeneralProductsPerPage = wp.element.lazy(() =>
  import(
    /* webpackChunkName: 'AdminSettingGeneralProductsPerPage-admin' */ "../../../../app/settings/general/general-products-per-page"
  )
)

const ProductsColorVariant = wp.element.lazy(() =>
  import(
    /* webpackChunkName: 'AdminSettingProductsColorVariant-admin' */ "../../../../app/settings/products/products-color-variant"
  )
)

const ProductsColorAddToCart = wp.element.lazy(() =>
  import(
    /* webpackChunkName: 'AdminSettingProductsColorAddToCart-admin' */ "../../../../app/settings/products/products-color-add-to-cart"
  )
)

const ProductsPlpDescriptionsToggle = wp.element.lazy(() =>
  import(
    /* webpackChunkName: 'AdminSettingProductsPlpDescriptionsToggle-admin' */ "../../../../app/settings/products/products-plp-descriptions-toggle"
  )
)

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
