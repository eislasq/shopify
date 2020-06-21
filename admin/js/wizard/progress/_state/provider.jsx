import WizardProgressReducer from "./reducer"
import WizardProgressInitialState from "./initial-state"
import WizardProgressContext from "./context"

function WizardProgressProvider(props) {
  const [state, dispatch] = wp.element.useReducer(
    WizardProgressReducer,
    WizardProgressInitialState(props)
  )

  const value = wp.element.useMemo(() => [state, dispatch], [state])

  return <WizardProgressContext.Provider value={value} {...props} />
}

export default WizardProgressProvider
