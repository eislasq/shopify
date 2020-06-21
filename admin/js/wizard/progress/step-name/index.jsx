/** @jsx jsx */
import { jsx, css } from "@emotion/core"

function StepName({ name, isActive }) {
  const nameCSS = css`
    display: inline-block;
    margin-left: 10px;
    font-size: 18px;
    color: #000;
  `

  return <span css={nameCSS}>{name}</span>
}

export default StepName
