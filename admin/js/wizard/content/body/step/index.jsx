/** @jsx jsx */
import { jsx, css } from "@emotion/core"
import WizardContext from "../../../_state/context"
import ErrorCallToAction from "../error"
import { ConnectionStatus } from "../../../../app/admin/connection-status"

function ContentStep({ content = false, header, step }) {
  const { useContext } = wp.element
  const { Card, Notice } = wp.components
  const [wizardState] = useContext(WizardContext)

  const statusCSS = css`
    text-align: center;
    margin-top: 10px;
    margin-bottom: 15px;
    border-bottom: 1px solid #e2e4e7;
    padding-bottom: 20px;

    .wpshopify-status {
      position: relative;
      left: -5px;
      color: #23282d;
    }
  `

  const cardCSS = css`
    @keyframes fadeInRight {
      from {
        transform: translate3d(40px, 0, 0);
      }

      to {
        transform: translate3d(0, 0, 0);
        opacity: 1;
      }
    }
    padding: 1em;
    max-width: 500px;
    margin: 0 auto;
    opacity: 0;
    animation-duration: 0.5s;
    animation-fill-mode: both;
    animation-name: ${wizardState.activeStep === step ? "fadeInRight" : "none"};

    .components-card__body > .components-spinner {
      margin: 0 auto;
      display: block;
    }
  `

  const headerCSS = css`
    @keyframes fadeInUp {
      from {
        transform: translate3d(0, 20px, 0);
      }

      to {
        transform: translate3d(0, 0, 0);
        opacity: 1;
      }
    }

    text-align: center;
    margin-bottom: 2em;
    animation-duration: 0.3s;
    animation-fill-mode: both;
    animation-name: ${wizardState.isFinished ? "fadeInUp" : "none"};
  `

  return (
    wizardState.activeStep === step && (
      <>
        <header css={headerCSS}>{header}</header>
        {content && (
          <Card css={cardCSS}>
            <ConnectionStatus
              customCSS={statusCSS}
              hasConnection={wizardState.hasConnection}
              storeName={wizardState.storeName}
              isChecking={wizardState.isLoadingConnection}
            />
            {wizardState.error ? (
              <Notice status="error" isDismissible={false}>
                {wizardState.error} <ErrorCallToAction />
              </Notice>
            ) : (
              content
            )}
          </Card>
        )}
      </>
    )
  )
}

export default ContentStep
