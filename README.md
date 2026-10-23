# Hazelchat

## Description

Add the [Hazelchat](https://hazelchat.co/) AI chat agent to your website with Matomo Tag Manager, and see in Matomo how visitors use it.

Hazelchat answers your visitors from your own website and documents, shows the sources it used, and passes enquiries on to you when it cannot help. You build and test your agent in Hazelchat; this plugin connects it to Matomo.

**What the plugin adds**

- **A Tag Manager tag, "Hazelchat Chat".** Paste your public widget key, choose the Pageview trigger and publish. No change to your website's code.
- **A Hazelchat page under Behaviour.** Chats opened, chats started and enquiries for the period and segment you pick. Also available as a dashboard widget.
- **Count enquiries as a goal.** One button creates the goal "Hazelchat enquiry", so goal reports show which pages, channels and campaigns bring enquiries.

**Where the numbers come from**

When Matomo is on the page, the Hazelchat chat adds three events to the visit, in the category `Hazelchat`: `Chat opened`, `Chat started` and `Chat enquiry`. They go through your own Matomo tracker, so your Matomo consent settings apply. The events carry no chat text, no page details and no personal details, and nothing from Matomo is sent to Hazelchat. The events also work without this plugin (for example on Matomo Cloud), as ordinary events under Behaviour › Events.

**What you need**

- A Hazelchat account. The Free plan covers one website.
- Matomo 5 On-Premise (or Matomo for WordPress). The tag needs Matomo Tag Manager, which comes with Matomo.

### How to use it

1. In Hazelchat, open **Website › Install on your website** and copy your public widget key.
2. In Matomo, open **Tag Manager**, choose your container, then **Tags › Create new tag**, and pick **Hazelchat Chat**.
3. Paste the key, choose the **Pageview** trigger, save and **Publish**.
4. In Hazelchat, add your website address and click **I've added the code**.
5. In Matomo, open **Behaviour › Hazelchat** and click **Count enquiries as a goal**.

The chat appears once your agent is live for the website in Hazelchat. If you already added the chat another way, skip steps 2–4: the events and the Hazelchat page work however the chat was added.

### Privacy

The tag loads `https://app.hazelchat.co/widget.js` with your public widget key; the key gives no access to your Hazelchat account. What the chat collects, and why, is in Hazelchat's [privacy notice](https://hazelchat.co/privacy/) and [data processing agreement](https://hazelchat.co/dpa/). Mention Hazelchat in your own privacy notice, as you would for any chat on your site.

This plugin adds no tracker code and no database table, and makes no request of its own.

### Support

- Guide: <https://hazelchat.co/integrations/matomo/>
- Questions about Hazelchat: <hello@hazelchat.co>
- Problems with this plugin: [open an issue](https://github.com/hazelchat-co/matomo-plugin-Hazelchat/issues)
