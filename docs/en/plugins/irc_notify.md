Plugin IRC Notify
=================

Connects to an IRC server and sends a defined message.

Configuration
-------------

#### Build Settings options

* **irc_notify** - All child properties are required
    * **server** - IRC server to connect to.
    * **port** - IRC server port, defaults to 6667.
    * **room** - The room you wish to send your message to (must start with a #)
    * **nick** - The nickname you want the bot to use.
    
### Plugin options

* **message** [string, required] - The message to send.
