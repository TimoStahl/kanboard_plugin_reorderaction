# Kanboard Plugin ReorderAction

Kanboard Plugin to reoder a column by automatic action

Events:

- Task created or updated
- Task moved to another column
- Task moved to another swimlane
- Task assignee change

_At the moment there is no useable event to combine the triggers, therefore the action should be configured multiple times._

Parameter:

- Column
- Criteria: Priority, Assignee, Due date
- Direction: Ascending, Descending

Plugin for <https://github.com/kanboard/kanboard>

## Author

- [BlueTeck](https://github.com/BlueTeck)
- License MIT

## Installation

- Decompress the archive in the `plugins` folder

or

- Create a folder **plugins/ReorderAction**
- Copy all files under this directory
