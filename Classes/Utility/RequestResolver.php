<?php
namespace FluidTYPO3\Vhs\Utility;

/*
 * This file is part of the FluidTYPO3/Vhs project under GPLv2 or later.
 *
 * For the full copyright and license information, please read the
 * LICENSE.md file that was distributed with this source code.
 */

use TYPO3\CMS\Extbase\Mvc\Request;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

class RequestResolver
{
    /**
     * @return Request|ServerRequest
     */
    public static function resolveRequestFromRenderingContext(
        RenderingContextInterface $renderingContext
    ) {
        $request = null;
        if (method_exists($renderingContext, 'getRequest')) {
            /** @var Request|ServerRequest */
            $request = $renderingContext->getRequest();
        } elseif (method_exists($renderingContext, 'getControllerContext')) {
            /** @var Request */
            $request = $renderingContext->getControllerContext()->getRequest();
        }
        if (!$request) {
            throw new \UnexpectedValueException('Unable to resolve request from RenderingContext', 1673191812);
        }
        return $request;
    }
}
