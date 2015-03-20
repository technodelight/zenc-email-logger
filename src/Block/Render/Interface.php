<?php

interface Zenc_EmailLogger_Block_Render_Interface
{
    /**
     * Always the content type string for the given renderer
     *
     * @return string
     */
    public function getContentType();

    /**
     * Should render the contents and return with a string
     *
     * @return string
     */
    public function toHtml();
}
