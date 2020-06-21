import GeneralPageProducts from "../../../../app/settings/general/page-products"
import GeneralPageCollections from "../../../../app/settings/general/page-collections"
import GeneralEnableDefaultPages from "../../../../app/settings/general/enable-default-pages"
import GeneralProductsLinkTo from "../../../../app/settings/general/products-link-to"
import GeneralProductsLinkTarget from "../../../../app/settings/general/products-link-target"
import EnableProductDetailPages from "../../../../app/settings/general/enable-product-detail-pages"

function GeneralContent() {
  const { Suspense } = wp.element
  const { Spinner, CardBody } = wp.components

  return (
    <CardBody>
      <Suspense fallback={<Spinner />}>
        <GeneralEnableDefaultPages />
        <GeneralPageProducts />
        <GeneralPageCollections />
        <EnableProductDetailPages />
        <GeneralProductsLinkTo />
        <GeneralProductsLinkTarget />
      </Suspense>
    </CardBody>
  )
}

export default GeneralContent
