<?php

namespace Kanboard\Plugin\ReorderAction\Action;

use Kanboard\Action\Base;
use Kanboard\Model\TaskModel;

class ReorderColumnAction extends Base
{
    /**
     * Get automatic action description.
     *
     * @return string
     */
    public function getDescription()
    {
        return t('Reorder a column if task changed');
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
            'column_id' => t('Column'),
            'criteria' => [t('Priority'), t('Assignee'), t('Due date')],
            'direction' => [t('Ascending'), t('Descending')],
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
        $direction = $this->getParam('direction') == 0 ? 'asc' : 'desc';
        $project_id = $data['task']['project_id'];
        $swimlane_id = $data['task']['swimlane_id'];
        $column_id = $data['task']['column_id'];

        switch ($criteria) {
            case 0:
                $this->taskReorderModel->reorderByPriority($project_id, $swimlane_id, $column_id, $direction);

                break;
            case 1:
                $this->taskReorderModel->reorderByAssignee($project_id, $swimlane_id, $column_id, $direction);

                break;
            case 2:
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
        return $data['task']['column_id'] == $this->getParam('column_id');
    }
}
