import { v4 as uuidv4 } from "uuid"
import Step from "../step"
import WizardProgressContext from "../_state/context"

function Steps() {
  const { useContext } = wp.element
  const [wizardProgressState] = useContext(WizardProgressContext)

  return wizardProgressState.steps.map((step) => (
    <Step
      key={uuidv4()}
      number={step.number}
      name={step.name}
      isLast={step.isLast}
    />
  ))
}

export default Steps
