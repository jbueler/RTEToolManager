# RTE Tool Manager
Makes managing your Rich Text Editor Tools easy. Build add-ons to the default EE Rich Text Editor, and manage their installation status in the admin.

### Installation
Copy the `rte_tool_manager` directory into the Expression Engine `third_party` directory. Then install the module as per usual.

After the module is installed you should be able to click through to the module homepage. You will find a list of all available RTE Tools and their status.

### How to install new RTE Tools
* Drop the rte package (`example` is given with the module) into the third_party directory.
* Go back to the RTE Tool Manager in the admin.
* Find the RTE tool you want to instal
* Click `Enable?`

### How to CREATE new RTE Tools
This add on doesn't really help build the RTE tools. It simply helps you install them. For more information on how to create RTE tools for Expression Engine please see the [Ellis Labs RTE Api](http://ellislab.com/expressionengine/user-guide/development/rte_tools.html)

#### Disclaimer
This functionality does not appear to be supported by Ellis Labs, if it were, it seems like they would have the UI for it in the admin. Use this at your own risk, I am going to continue working through some issues with regards to the display order of the buttons and clean up of the database records. Feel free to leave comments on github.