__webpack_public_path__ = wpshopify.misc.pluginsDistURL
import App from "./app"

function initWizard() {
  if (
    wpshopify.settings.general.wizardCompleted ||
    !window.location.search.includes("?page=wpshopify-wizard")
  ) {
    return
  }

  document.documentElement.classList.remove("wp-toolbar")

  jQuery(() => {
    wp.element.render(<App />, document.getElementById("wpshopify-wizard"))
  })
}

initWizard()
