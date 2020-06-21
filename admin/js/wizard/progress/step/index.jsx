import StepNumber from "../step-number"
import StepDiver from "../step-divider"
import StepName from "../step-name"
import WizardContext from "../../_state/context"
import { mq } from "../../../app/admin/_common/utils"
/** @jsx jsx */
import { jsx, css } from "@emotion/core"

function Step({ number, name, isLast = false }) {
  const { useContext } = wp.element
  const [wizardState] = useContext(WizardContext)
  const buttonCSS = css`
    background: none;
    border: none;
    display: flex;
    align-items: center;
    outline: none;

    ${mq("wide")} {
      width: ${number === 4 ? "auto" : "32%"};
    }
  `

  return (
    <button css={buttonCSS}>
      <StepNumber
        number={number}
        isActive={wizardState.activeStep === number}
        isCompleted={wizardState.completedSteps.includes(number)}
      />
      <StepName name={name} isActive={wizardState.activeStep === number} />
      {!isLast && <StepDiver />}
    </button>
  )
}

export default Step
