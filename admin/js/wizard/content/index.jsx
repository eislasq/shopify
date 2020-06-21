/** @jsx jsx */
import { jsx, css } from "@emotion/core"
import WizardContext from "../_state/context"

function WizardContent({ children }) {
  const { useContext } = wp.element
  const [wizardState] = useContext(WizardContext)

  // TODO: Remove these styles
  const WizardContentCSS = css`
    max-width: 800px;
    margin: ${wizardState.isFinished
      ? "102px auto 0 auto"
      : "42px auto 0 auto"};

    .components-card {
      position: relative;
      min-height: 250px;
      z-index: 2;
    }

    .components-popover {
      position: static;
      z-index: 2;
      margin-top: 0;
    }

    .components-popover:not(.is-without-arrow)[data-y-axis="bottom"] {
      margin-top: 0;

      &:before {
        left: 50%;
        top: 3px;
        border-top-color: transparent;
        border-bottom-color: #cfcfcf;
      }
    }

    .components-popover__content {
      top: 10px;

      &:after {
        top: 3px;
      }
    }
  `

  return <div css={WizardContentCSS}>{children}</div>
}

export default WizardContent
