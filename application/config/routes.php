<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
https://codeigniter.com/userguide3/general/routing.html
*/

$route['api/calendario']                        = 'Api_Calendario/calendario';
$route['api/agenda']                            = 'Api_Calendario/agenda';

$route['api/event/(:num)']                      = 'Api_Event/event/$1';
$route['api/event/going/(:num)']                = 'Api_Event/going/$1';

$route['api/login']                             = 'Api_Authentication/login';
$route['api/logout']                            = 'Api_Authentication/logout';

$route['api/user']                              = 'Api_User/user';

$route['api/notifications/new']                 = 'Api_Notification/new';
$route['api/notifications/all']                 = 'Api_Notification/all';
$route['api/notification/(:num)']               = 'Api_Notification/notification/$1';

$route['api/removeForum/(:num)']                = 'Api_Forum/removeForum/$1';
$route['api/removePost/(:num)']                 = 'Api_Forum/removePost/$1';
$route['api/getForumById/(:num)']               = 'Api_Forum/getForumById/$1';
$route['api/getAllByForumId/(:num)']            = 'Api_Forum/getThreadsByForumId/$1';
$route['api/insertThread']                      = 'Api_Forum/insertThread';
$route['api/getThread/(:num)']                  = 'Api_Forum/getThreadById/$1';
$route['api/insertPost']                        = 'Api_Forum/insertPost';
$route['api/insertForum']                       = 'Api_Forum/insertForum';

$route['api/getHome/(:num)']                    = 'Api_Teacher/getProfHome/$1';

$route['api/createProject']                     = 'Api_Project/createProject';
$route['api/createEtapa']                       = 'Api_Project/createEtapa';
$route['api/insertFeedback']                    = 'Api_Project/insertFeedback';
$route['api/editEtapa']                         = 'Api_Project/editEtapa';
$route['api/editEnunciado']                     = 'Api_Project/editEnunciado';
$route['api/editEtapaEnunciado']                = 'Api_Project/editEtapaEnunciado';
$route['api/submitEtapa']                       = 'Api_Project/submitEtapa';

$route['api/getSub']                            = 'Api_Project/getSub';
$route['api/getAllEtapas/(:num)']               = 'Api_Project/getAllEtapas/$1';
$route['api/getAllGroups/(:num)']               = 'Api_Project/getAllGroups/$1';
$route['api/getMyGroupInProj/(:num)']           = 'Api_Project/getMyGroupInProj/$1';
$route['api/leaveMyGroup/(:num)']               = 'Api_Project/leaveMyGroup/$1';
$route['api/getSubmission/(:num)']              = 'Api_Project/getSubmission/$1';

$route['api/removeProject/(:num)']              = 'Api_Project/removeProject/$1';
$route['api/removeEtapa/(:num)']                = 'Api_Project/removeEtapa/$1';
$route['api/removeEnunciadoEtapa/(:num)']       = 'Api_Project/removeEnunciadoEtapa/$1';
$route['api/removeEnunciadoProj/(:num)']        = 'Api_Project/removeEnunciadoProj/$1';

$route['api/getCadeira/(:num)']                 = 'Api_Subject/getInfo/$1';
$route['api/insertText']                        = 'Api_Subject/insertText';
$route['api/getHours/(:num)']                   = 'Api_Subject/getHours/$1';
$route['api/insertHours']                       = 'Api_Subject/saveHours';
$route['api/removeHours']                       = 'Api_Subject/removeHours';
$route['api/addEvent/(:num)']                   = 'Api_Subject/insertEvent/$1';
$route['api/getCadeiras/(:num)/(:any)']         = 'Api_Subject/getCadeiras/$1/$2';
$route['api/getCadeirasOrder/(:num)/(:any)']    = 'Api_Subject/getCadeirasOrder/$1/$2';
$route['api/getCourseStudents/(:num)']          = 'Api_Subject/getCourseStudents/$1';
$route['api/insertDate/(:num)/(:any)']          = 'Api_Subject/insertDate/$1/$2';

$route['api/getAllTasks/(:num)']                = 'Api_Student/getAllTasks/$1';


$route['api/getProjectStatus']                  = 'Api_Project/getProjectStatus';
$route['api/getMyGroups']                       = 'Api_Student/getMyGroups';


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
$route['api/getAllCourses']                     = 'Api_Course/getAllCourses';
$route['api/getAllSchoolYears']                 = 'Api_Year/getAllSchoolYears';
$route['api/getAllStudents']                    = 'Api_Student/getAllStudents';
$route['api/getAllTeachers']                    = 'Api_Teacher/getAllTeachers';
$route['api/getAdminHome']                      = 'Api_Admin/getAdminHome';
$route['api/getAllCursosFaculdadeAno']          = 'Api_Course/getAllCollegesYearCourses';
$route['api/getAllCursosFaculdade']             = 'Api_Course/getAllCollegesCourses';
$route['api/getAllSubjects']                    = 'Api_Subject/getAllSubjects';
// $route['api/getAllSubjectsByCourse']            = 'Api_Subject/getAllSubjectsByCourse';
// $route['api/getAllCoursesByYear']               = 'Api_Course/getAllCoursesByYear';
$route['api/getSubjectsByFilters']              = 'Api_Subject/getSubjectsByFilters';
$route['api/editSubject']                       = 'Api_Subject/editSubject';
$route['api/saveCSV']                           = 'Api_Admin/export';
$route['api/importX']                           = 'Api_Admin/importX';
$route['api/deleteUser']                        = 'Api_User/deleteUser';
$route['api/deleteCollege']                     = 'Api_College/deleteCollege';
$route['api/deleteSubject']                     = 'Api_Subject/deleteSubject';
$route['api/deleteSchoolYear']                  = 'Api_Year/deleteSchoolYear';
$route['api/deleteCourse']                      = 'Api_Course/deleteCourse';


#Raul#ja arrumo#dw#

$route['default_controller'] = 'landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

