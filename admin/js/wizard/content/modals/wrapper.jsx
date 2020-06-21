/** @jsx jsx */
import { jsx, css } from "@emotion/core"
import WizardContext from "../../_state/context"

function ModalWrapper(props) {
  const { Modal } = wp.components
  const { useContext } = wp.element
  const [wizardState, wizardDispatch] = useContext(WizardContext)

  const closeModal = (e) => {
    wizardDispatch({ type: "SET_ACTIVE_MODAL", payload: false })
  }

  const modalCSS = css`
    .components-modal__header-heading-container {
      text-align: center;
    }
    .components-modal__header-heading {
      margin: 0 auto;
    }

    .components-modal__header .components-modal__header-heading {
      font-size: 1.3rem;
    }
  `

  return (
    <Modal onRequestClose={(e) => closeModal(e)} css={modalCSS} {...props}>
      {props.children}
    </Modal>
  )
}

export default ModalWrapper
