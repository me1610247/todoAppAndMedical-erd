<?php

function sanitizeInput($input){
    return htmlspecialchars(htmlentities(trim($input)));
}
