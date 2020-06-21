import Steps from "./steps"
/** @jsx jsx */
import { jsx, css } from "@emotion/core"
import { mq } from "../../app/admin/_common/utils"
import Row from "../../app/admin/row"
import WizardProgressProvider from "./_state/provider"
import WizardContext from "../_state/context"

function WizardProgress() {
  const { useContext } = wp.element
  const [wizardState] = useContext(WizardContext)
  const { Card, CardHeader } = wp.components

  const CardHeaderCSS = css`
    max-width: 99vw;
    margin: 0 auto;
  `

  const CardCSS = css`
    height: 60px;
  `

  const customRowCSS = css`
    flex: 1;
    justify-content: space-between;
    max-width: 70vw;
    margin: 0 auto;

    ${mq("laptop")} {
      position: relative;
      left: -33px;
    }

    ${mq("wide")} {
      max-width: 100%;
      left: 0;
    }
  `

  return (
    !wizardState.isFinished && (
      <Card css={CardCSS}>
        <CardHeader css={CardHeaderCSS}>
          <Row align="start">
            <Row align="center" customCSS={customRowCSS}>
              <WizardProgressProvider>
                <Steps />
              </WizardProgressProvider>
            </Row>
          </Row>
        </CardHeader>
      </Card>
    )
  )
}

export default WizardProgress
