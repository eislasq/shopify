/** @jsx jsx */
import { jsx, css } from "@emotion/core"
import { IconCheckMark } from "../../_common/icons"

function StepNumber({ number, isActive = false, isCompleted = false }) {
  const numberCSS = css`
    border-radius: 50%;
    background: ${isActive && !isCompleted
      ? "#415aff;"
      : isCompleted
      ? "#39d0ae"
      : "#e4e4e4"};
    color: ${isActive || isCompleted ? "white" : "black"};
    padding: 7px;
    width: 15px;
    height: 15px;
    display: inline-block;
    font-size: 15px;
    line-height: 1;
    position: relative;
    transition: all 0.2s ease;
  `

  return <span css={numberCSS}>{isCompleted ? <IconCheckMark /> : number}</span>
}

export default StepNumber
