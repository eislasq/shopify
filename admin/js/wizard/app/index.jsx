import { AdminProvider } from "../../app/admin/_state/provider"
import SettingsProvider from "../../app/settings/_state/provider"
import SettingsWrapper from "../../app/settings/wrapper"
import WizardProgress from "../progress"
import WizardContent from "../content"
import WizardBody from "../content/body"
import WizardFooter from "../content/footer"
import WizardProvider from "../_state/provider"

function App() {
  return (
    <section id="wpshopify-wizard-app">
      <AdminProvider options={wpshopify}>
        <WizardProvider>
          <WizardProgress />
          <WizardContent>
            <SettingsProvider>
              <SettingsWrapper>
                <WizardBody />
              </SettingsWrapper>
              <WizardFooter />
            </SettingsProvider>
          </WizardContent>
        </WizardProvider>
      </AdminProvider>
    </section>
  )
}

export default App
