<?php

/**
 * 公共函数库
 */

if (!function_exists('deny')) {

    /**
     * 40X deny helper
     * only for 401 Unauthorized, 403 Forbidden and 404 Not Found errors
     *
     * @param  string $site site alias name
     * @param 
     * @return \Response
     */
    function deny($site = 'admin', $status = 403)
    {
        if (!in_array($status, [401, 403, 404])) {
            return $status = 403;
        }

        switch ($site) {
            case 'admin':
                return response()->view('admin.errors.'.$status, [], $status);
                break;
            case 'desktop':
                return reponse()->view('desktop.errors.'.$status, [], $status);
                break;
            case 'mobile':
                return reponse()->view('mobile.errors.'.$status, [], $status);
                break;
            default:
                return response()->view('errors.'.$status, [], $status);
                break;
        }
    }
}
