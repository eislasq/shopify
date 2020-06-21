import { mq } from "../../../app/admin/_common/utils"

/** @jsx jsx */
import { jsx, css } from "@emotion/core"

function StepDiver() {
  const dividerCSS = css`
    width: 14vw;
    height: 2px;
    background: #cacaca;
    margin-left: 18px;
    margin-top: 3px;
    position: relative;

    ${mq("wide")} {
      flex: 1;
    }
  `

  return <span css={dividerCSS} />
}

export default StepDiver
