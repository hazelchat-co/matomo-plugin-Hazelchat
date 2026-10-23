## Add the chat with Tag Manager

1. In Hazelchat, open **Website › Install on your website** and copy your public widget key (64 characters). You can also paste the whole installation code; the tag keeps only the key.
2. In Matomo, open **Tag Manager**, choose your container, then **Tags › Create new tag** and pick **Hazelchat Chat**.
3. Paste the key and choose the **Pageview** trigger. Save, then **Publish** the container.
4. In Hazelchat, add your website address and click **I've added the code**.

The chat stays hidden until your agent is live for that website in Hazelchat. The tag loads the chat once per page, even if the container fires it again.

**Wait for my cookie banner** (off by default): the chat then waits until your website tells it that the visitor agreed. Most cookie banners that Hazelchat supports work without this box; see Hazelchat's [cookie banner guide](https://hazelchat.co/integrations/cookie-banners/).

## See chats in Matomo

Open **Behaviour › Hazelchat**. It shows, for the selected period and segment:

| Number | Counted when |
| --- | --- |
| Chats opened | A visitor opens the chat. |
| Chats started | A visitor's first question in a new conversation is answered. A conversation continued on the next page is not counted again. |
| Enquiries | A visitor leaves an enquiry in the chat. |

The numbers are the chat's events (category `Hazelchat`, actions `Chat opened`, `Chat started`, `Chat enquiry`). You find them under **Behaviour › Events** too, and can use them in segments, for example "Event category is Hazelchat".

## Count enquiries as a goal

Click **Count enquiries as a goal** on the Hazelchat page. It creates the goal **Hazelchat enquiry** for this website: event action is exactly `Chat enquiry`, counted once per visit. You need write access to the website. You can rename the goal or give it a revenue value later under **Goals › Manage goals**.
