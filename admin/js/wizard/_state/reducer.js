import findIndex from "lodash/findIndex"
import update from "immutability-helper"

function WizardReducer(state, action) {
  switch (action.type) {
    case "SET_ACTIVE_STEP": {
      return {
        ...state,
        activeStep: update(state.activeStep, { $set: action.payload }),
      }
    }

    case "SET_ACTIVE_MODAL": {
      return {
        ...state,
        activeModal: update(state.activeModal, { $set: action.payload }),
      }
    }

    case "SET_IS_BUSY": {
      return {
        ...state,
        isBusy: update(state.isBusy, { $set: action.payload }),
      }
    }

    case "SET_EXISTING_CONNECTION_VALUES": {
      return {
        ...state,
        existingConnectionValues: update(state.existingConnectionValues, {
          $set: action.payload,
        }),
      }
    }

    case "SET_IS_LOADING_CONNECTION": {
      return {
        ...state,
        isLoadingConnection: update(state.isLoadingConnection, {
          $set: action.payload,
        }),
      }
    }

    case "SET_CONNECTION": {
      return {
        ...state,
        hasConnection: update(state.hasConnection, { $set: action.payload }),
      }
    }

    case "SET_IS_FINISHED": {
      return {
        ...state,
        isFinished: update(state.isFinished, { $set: action.payload }),
      }
    }

    case "RESET_NOTICES": {
      return {
        ...state,
        notices: update(state.notices, { $set: [] }),
      }
    }

    case "SET_STORE_NAME": {
      return {
        ...state,
        storeName: update(state.storeName, { $set: action.payload }),
      }
    }

    case "SET_ERROR": {
      return {
        ...state,
        error: update(state.error, { $set: action.payload }),
      }
    }

    case "UPDATE_NOTICES":
      var index = findIndex(state.notices, {
        content: action.payload[0].content,
      })

      if (index !== -1) {
        return {
          ...state,
        }
      }

      return {
        ...state,
        notices: update(state.notices, { $push: action.payload }),
      }

    case "UPDATE_COMPLETED_STEPS": {
      if (action.payload.operation === "add") {
        if (state.completedSteps.includes(action.payload.step)) {
          return state
        }

        return {
          ...state,
          completedSteps: update(state.completedSteps, {
            $push: [action.payload.step],
          }),
        }
      }

      if (action.payload.operation === "remove") {
        if (!state.completedSteps.includes(action.payload.step)) {
          return state
        }

        var index = state.completedSteps.indexOf(action.payload.step)

        if (index !== -1) {
          return {
            ...state,
            completedSteps: update(state.completedSteps, {
              $apply: (arr) => {
                arr.splice(index, 1)
                return arr
              },
            }),
          }
        }

        return state
      }

      return state
    }

    default: {
      throw new Error(`Unhandled action type: ${action.type} in WizardReducer`)
    }
  }
}

export default WizardReducer
