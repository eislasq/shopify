import update from "immutability-helper"

function WizardProgressReducer(state, action) {
  switch (action.type) {
    default: {
      throw new Error(
        `Unhandled action type: ${action.type} in WizardProgressReducer`
      )
    }
  }
}

export default WizardProgressReducer
