<?php

namespace Kanboard\Plugin\ReorderAction\Action;

use Kanboard\Action\Base;
use Kanboard\Model\TaskModel;

class ReorderEveryColumnAction extends Base
{
    /**
     * Get automatic action description.
     *
     * @return string
     */
    public function getDescription()
    {
        return t('Reorder every column by defined criteria');
    }

    /**
     * Get the list of compatible events.
     *
     * @return array
     */
    public function getCompatibleEvents()
    {
        return [
            TaskModel::EVENT_CREATE_UPDATE,
            TaskModel::EVENT_MOVE_COLUMN,
            TaskModel::EVENT_MOVE_SWIMLANE,
            TaskModel::EVENT_ASSIGNEE_CHANGE,
        ];
    }

    /**
     * Get the required parameter for the action (defined by the user).
     *
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return [
            'criteria' => [
                'Priority' => t('Priority'), 
                'Assignee' => t('Assignee'), 
                'Assignee and priority' => t('Assignee and priority'), 
                'Due date' => t('Due date')
            ],
            'direction' => [
                'Ascending' => t('Ascending'), 
                'Descending' => t('Descending')
            ],
        ];
    }

    /**
     * Get the required parameter for the event.
     *
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return [
            'task_id',
            'task' => [
                'project_id',
                'column_id',
                'swimlane_id',
            ],
        ];
    }

    /**
     * Execute the action (assign the given user).
     *
     * @param array $data Event data dictionary
     *
     * @return bool True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        $criteria = $this->getParam('criteria');
        $direction = 'Ascending' == $this->getParam('direction') ? 'asc' : 'desc';
        $project_id = $data['task']['project_id'];
        $swimlane_id = $data['task']['swimlane_id'];
        $column_id = $data['task']['column_id'];

        switch ($criteria) {
            case 'Priority':
                $this->taskReorderModel->reorderByPriority($project_id, $swimlane_id, $column_id, $direction);

                break;
            case 'Assignee':
                $this->taskReorderModel->reorderByAssignee($project_id, $swimlane_id, $column_id, $direction);

                break;
            case 'Assignee and priority':
                $this->taskReorderModel->reorderByAssigneeAndPriority($project_id, $swimlane_id, $column_id, $direction);

                break;
            case 'Due date':
                $this->taskReorderModel->reorderByDueDate($project_id, $swimlane_id, $column_id, $direction);

                break;
        }
    }

    /**
     * Check if the event data meet the action condition.
     *
     * @param array $data Event data dictionary
     *
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        return true;
    }
}
