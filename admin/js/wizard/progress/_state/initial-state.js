function WizardProgressInitialState(options) {
  return {
    steps: [
      {
        number: 1,
        name: wp.i18n.__("Connection", "wpshopify"),
        isLast: false,
      },
      {
        number: 2,
        name: wp.i18n.__("General", "wpshopify"),
        isLast: false,
      },
      {
        number: 3,
        name: wp.i18n.__("Products", "wpshopify"),
        isLast: false,
      },
      {
        number: 4,
        name: wp.i18n.__("Cart", "wpshopify"),
        isLast: true,
      },
    ],
  }
}

export default WizardProgressInitialState
