<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
https://codeigniter.com/userguide3/general/routing.html
*/

$route['api/calendario']                = 'Api_Calendario/fullCalendario';

$route['api/event/(:num)']              = 'Api_Event/event/$1';
$route['api/event/going/(:num)']        = 'Api_Event/going/$1';

$route['api/login']                     = 'Api_Authentication/login';
$route['api/logout']                    = 'Api_Authentication/logout';

$route['api/user/(:num)']               = 'Api_User/user/$1';

$route['api/removeForum/(:num)']        = 'Api_Forum/removeForum/$1';
$route['api/removePost/(:num)']         = 'Api_Forum/removePost/$1';
$route['api/getForumById/(:num)']       = 'Api_Forum/getForumById/$1';
$route['api/getAllByForumId/(:num)']    = 'Api_Forum/getThreadsByForumId/$1';
$route['api/insertThread']              = 'Api_Forum/insertThread';
$route['api/getThread/(:num)']          = 'Api_Forum/getThreadById/$1';
$route['api/insertPost']                = 'Api_Forum/insertPost';
$route['api/insertForum']                = 'Api_Forum/insertForum';

$route['api/getHome/(:num)']            = 'Api_Teacher/getProfHome/$1';


$route['api/createProject']                 = 'Api_Project/createProject';
$route['api/createEtapa']                   = 'Api_Project/createEtapa';
$route['api/insertFeedback']                = 'Api_Project/insertFeedback';
$route['api/editEtapa']                     = 'Api_Project/editEtapa';
$route['api/editEnunciado']                 = 'Api_Project/editEnunciado';
$route['api/editEtapaEnunciado']            = 'Api_Project/editEtapaEnunciado';

$route['api/getSub']                        = 'Api_Project/getSub';
$route['api/getAllEtapas/(:num)']           = 'Api_Project/getAllEtapas/$1';
$route['api/getAllGroups/(:num)']           = 'Api_Project/getAllGroups/$1';

$route['api/removeProject/(:num)']          = 'Api_Project/removeProject/$1';
$route['api/removeEtapa/(:num)']            = 'Api_Project/removeEtapa/$1';
$route['api/removeEnunciadoEtapa/(:num)']   = 'Api_Project/removeEnunciadoEtapa/$1';
$route['api/removeEnunciadoProj/(:num)']    = 'Api_Project/removeEnunciadoProj/$1';



$route['api/getCadeira/(:num)']         = 'Api_Subject/getInfo/$1';
$route['api/insertText']                = 'Api_Subject/insertText';
$route['api/getHours/(:num)']           = 'Api_Subject/getHours/$1';
$route['api/insertHours']                = 'Api_Subject/saveHours';
$route['api/removeHours']               = 'Api_Subject/removeHours';

$route['api/getCadeiras/(:num)']        = 'Api_Subject/getCadeiras/$1';

##ADMIN##

$route['api/register']                          = 'Api_User/registerUser';
$route['api/registerCollege']                   = 'Api_College/registerCollege';
$route['api/editUser']                          = 'Api_User/editUser';
$route['api/registerSubject']                   = 'Api_Subject/registerSubject';
$route['api/registerCurso']                     = 'Api_Course/registerCurso';
$route['api/registerSchoolYear']                = 'Api_Year/registerSchoolYear';
$route['api/getSearchTeacher']                  = 'Api_Teacher/getSearchTeacher';
$route['api/getSearchStudent']                  = 'Api_Student/getSearchStudent';
$route['api/editCourse']                        = 'Api_Course/editCourse';
$route['api/getAllColleges']                    = 'Api_College/getAllColleges';
$route['api/getAllSchoolYears']                 = 'Api_Year/getAllSchoolYears';
$route['api/getAllStudents']                    = 'Api_Student/getAllStudents';
$route['api/getAllTeachers']                    = 'Api_Teacher/getAllTeachers';
$route['api/getAdminHome']                      = 'Api_Admin/getAdminHome';
// $route['api/getAllFaculdadesUnidCurricular']    = 'Api_College/getAllColleges';
// $route['api/getAllYears']                       = 'Api_Year/getAllYears';




#Raul#ja arrumo#dw#

$route['default_controller'] = 'landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

