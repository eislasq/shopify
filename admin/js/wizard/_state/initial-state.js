function WizardInitialState(options) {
  return {
    activeStep: 1,
    completedSteps: [],
    error: false,
    activeModal: false,
    isFinished: false,
    isBusy: false,
    hasConnection: false,
    storeName: false,
    isLoadingConnection: true,
    existingConnectionValues: false,
  }
}

export default WizardInitialState
