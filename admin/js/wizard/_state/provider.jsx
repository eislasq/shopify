import WizardReducer from "./reducer"
import WizardInitialState from "./initial-state"
import WizardContext from "./context"

function WizardProvider(props) {
  const [state, dispatch] = wp.element.useReducer(
    WizardReducer,
    WizardInitialState(props)
  )

  const value = wp.element.useMemo(() => [state, dispatch], [state])

  return <WizardContext.Provider value={value} {...props} />
}

export default WizardProvider
