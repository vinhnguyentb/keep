<?php
namespace Keep\Jobs;

use Illuminate\Contracts\Bus\SelfHandling;
use Keep\Jobs\Templates\AssignmentTemplate;

class ModifyAssignment extends AssignmentTemplate implements SelfHandling
{
    /**
     * Modify assignment.
     *
     * @return void
     */
    public function handle()
    {
        $assignment = parent::$assignmentRepo->update(
            $this->getAssignmentSlug(),
            $this->getAssignmentRequestData()
        );
        $this->updateAssociatedTask($assignment->task);
        $this->updatePolymorphicRelations($assignment);
    }
}