__Does Matomo send anything to Hazelchat?__

No. The plugin makes no request of its own. The events go from the visitor's browser to your Matomo, through your own tracker.

__What do the events contain?__

Only the category `Hazelchat` and one of three actions: `Chat opened`, `Chat started`, `Chat enquiry`. No chat text, no name, no email address and no page details. Matomo records them with the visit, as it does any event.

__Do the events follow my consent settings?__

Yes. They use the Matomo tracker on your page. If you set Matomo to require consent, no event is sent before the visitor agrees.

__I use Matomo Cloud. Can I use this?__

The events work on Matomo Cloud without the plugin: you find them under Behaviour › Events. The tag and the Hazelchat page need the plugin, which Matomo Cloud does not let you install yourself.

__I added the chat without Tag Manager. Do I need the tag?__

No. The events and the Hazelchat page work however the chat was added.

__Can I turn the events off?__

Yes. Add `data-matomo="off"` to the Hazelchat installation code on your website.

__Why does my number differ from Hazelchat's own analytics?__

Matomo counts only visits it tracks: visitors who declined tracking, or who block Matomo, are not in Matomo but can still use the chat.
