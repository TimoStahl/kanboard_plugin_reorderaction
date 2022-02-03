# Kanboard Plugin ReorderAction

This software is in maintenance mode. It doesn't mean it's abandoned, but there is no significant feature development. Pull-requests are still accepted as long as the guidelines are followed.

Kanboard Plugin to reoder a column by automatic action

Actions:

- Reorder every column by defined criteria
- Reorder a single column by defined criteria

Events:

- Task created or updated
- Task moved to another column
- Task moved to another swimlane
- Task assignee change

_At the moment there is no useable event to combine the triggers, therefore the action should be configured multiple times._

Parameter:

- Column
- Criteria: Priority, Assignee, Assignee and priority, Due date
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
