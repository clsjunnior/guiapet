<?php
/**
 * Helper referente ao usuario
 */

function getSesUser($campos = null)
{

    $valores = null;
    $ci = &get_instance();

    $ci->load->library('session');

    $user = $ci->session->userdata('user');

    if (count($campos) == 0) {
        return $user;
    } elseif (count($campos) == 1) {
        return $user[$campos[0]];
    } else {
        foreach ($campos as $c) {
            if (array_key_exists($c, $user)) {
                $valores[$c] = $user[$c];
            } else {
                $valores[$c] = null;
            }
        }
        return $valores;
    }
}

function setSesUser($user)
{
    $ci = &get_instance();

    $ci->load->model('Locations', 'location');

    $session['user'] = $user;

    if (isset($user['location_id'])) {
        $session['location'] = $ci->location->getById($user['location_id'])->result_array()[0];
    }
    $ci->session->unset_userdata('user');
    $ci->session->unset_userdata('location');
    $ci->session->set_userdata($session);
}

function getSesLocation($campos = null)
{

    $valores = null;
    $ci = &get_instance();

    $ci->load->library('session');

    $location = $ci->session->userdata('location');

    if (!is_array($campos)) {
        return $location;
    } else {
        foreach ($campos as $c) {
            if (array_key_exists($c, $location)) {
                $valores[$c] = $location[$c];
            } else {
                $valores[$c] = null;
            }
        }
        return $valores;
    }
}

function setSesLocation($location)
{
    $ci = &get_instance();
    $session['location'] = $location;

    $ci->session->unset_userdata('location');

    $ci->session->set_userdata($session);
}