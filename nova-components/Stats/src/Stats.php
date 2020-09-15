<?php

namespace Phishing\Stats;

use Laravel\Nova\Card;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Hook;
use App\Models\Log;

class Stats extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Build.
     *
     * @param string  $relation
     * @param Request $request
     * @return $this
     */
    public function build($relation, Request $request = null)
    {
        $campaignId = $request ? $request->resourceId : null;

        $title = ucfirst($relation);

        if ($campaignId) {
            $campaign = Campaign::find($campaignId);
            $total = $campaign->hooks()->count();
            $current = $campaign->logs()->$relation()->distinct('hook_id')->count();
        } else {
            $total = Hook::count();
            $current = Log::$relation()->distinct('hook_id')->count();
        }

        switch ($relation) {
            case 'sent':
                $color = '#1abc9c';
            break;
            case 'opened':
                $color = '#f9bf3b';
            break;
            case 'clicked':
                $color = '#f39c12';
            break;
            case 'filled':
                $color = '#f0676a';
            break;
            case 'reported':
                $color = '#45D6EF';
            break;
        }

        return $this->withMeta([
            'title' => $title,
            'total' => $total,
            'current' => $current,
            'color' => $color,
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'stats';
    }
}
