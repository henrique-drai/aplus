<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
https://codeigniter.com/userguide3/general/routing.html
*/

$route['api/calendario']                        = 'Api_Calendario/calendario';
$route['api/calendario/export']                 = 'Api_Calendario/export';
$route['api/grupo/(:num)/calendario']           = 'Api_Calendario/grupo/$1';
$route['api/agenda']                            = 'Api_Calendario/agenda';

$route['api/event/group/(:num)']                = 'Api_Event/meeting/$1';
$route['api/event/(:num)']                      = 'Api_Event/event/$1';
$route['api/event/going/(:num)']                = 'Api_Event/going/$1';
$route['api/event/invite/(:num)']               = 'Api_Event/invite/$1';
$route['api/removeEvent/(:num)']                = 'Api_Event/removeEventByHourId/$1';

$route['api/login']                             = 'Api_Authentication/login';
$route['api/logout']                            = 'Api_Authentication/logout';

$route['api/user']                              = 'Api_User/user';

$route['api/notifications/new']                 = 'Api_Notification/new';
$route['api/notifications/all']                 = 'Api_Notification/all';
$route['api/notification/(:num)']               = 'Api_Notification/notification/$1';

$route['api/removeForum/(:num)']                = 'Api_Forum/removeForum/$1';
$route['api/removePost/(:num)']                 = 'Api_Forum/removePost/$1';
$route['api/removeThread/(:num)']               = 'Api_Forum/removeThread/$1';
$route['api/getForumById/(:num)']               = 'Api_Forum/getForumById/$1';
$route['api/getAllByForumId/(:num)']            = 'Api_Forum/getThreadsByForumId/$1';
$route['api/insertThread']                      = 'Api_Forum/insertThread';
$route['api/getThread/(:num)']                  = 'Api_Forum/getThreadById/$1';
$route['api/insertPost']                        = 'Api_Forum/insertPost';
$route['api/insertForum']                       = 'Api_Forum/insertForum';

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
$route['api/showNotFullGroup/(:num)']           = 'Api_Project/showNotFullGroup/$1';
$route['api/criarGrupo/(:num)']                 = 'Api_Project/criarGrupo/$1';
$route['api/entrarGrupo/(:num)']                = 'Api_Project/entrarGrupo/$1';


$route['api/removeProject/(:num)']              = 'Api_Project/removeProject/$1';
$route['api/removeEtapa/(:num)']                = 'Api_Project/removeEtapa/$1';
$route['api/removeEnunciadoEtapa/(:num)']       = 'Api_Project/removeEnunciadoEtapa/$1';
$route['api/removeEnunciadoProj/(:num)']        = 'Api_Project/removeEnunciadoProj/$1';

$route['api/submitRating']                      = 'Api_Project/submitRating';
$route['api/getStudentsFromGroup']              = 'Api_Project/getStudentsFromGroup';

$route['api/submitFileAreaGrupo']               = 'Api_Project/submitFileAreaGrupo';
$route['api/getFicheirosGrupo/(:num)']          = 'Api_Project/getFicheirosGrupo/$1';
$route['api/removeFicheiroAreaGrupo/(:num)']    = 'Api_Project/removeFicheiroAreaGrupo/$1';

$route['api/exportCSVTasks']                    = 'Api_Project/export';

$route['api/getGroupMembers/(:num)']            = 'Api_Project/getGroupMembers/$1';
$route['api/insertTask']                        = 'Api_Project/insertTask';
$route['api/getTasks/(:num)']                   = 'Api_Project/getTasks/$1';
$route['api/deleteTaskById/(:num)']             = 'Api_Project/deleteTaskById/$1';
$route['api/getTaskById/(:num)']                = 'Api_Project/getTaskById/$1';
$route['api/insertTaskStartDate/(:num)']        = 'Api_Project/insertTaskStartDate/$1';
$route['api/insertTaskEndDate/(:num)']          = 'Api_Project/insertTaskEndDate/$1';
$route['api/editTask/(:num)']                   = 'Api_Project/editTask/$1';
$route['api/updateTaskById/(:num)']             = 'Api_Project/updateTaskById/$1';

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
$route['api/deleteHourById']                    = 'Api_Subject/deleteHourById';
$route['api/submitFileAreaCadeira']             = 'Api_Subject/submitFileAreaCadeira';

$route['api/getFicheirosCadeira/(:num)']        = 'Api_Subject/getFicheirosCadeira/$1';
$route['api/removeFicheiroAreaCadeira/(:num)']  = 'Api_Subject/removeFicheiroAreaCadeira/$1';


$route['api/getProjectStatus']                  = 'Api_Project/getProjectStatus';
$route['api/getMyGroups']                       = 'Api_Student/getMyGroups';

$route['api/getSearchStudentCourse']            = 'Api_Subject/getSearchStudentCourse';


##ADMIN##
$route['api/register']                          = 'Api_User/registerUser';
$route['api/editUser']                          = 'Api_User/editUser';
$route['api/deleteUser']                        = 'Api_User/deleteUser';
$route['api/registerCollege']                   = 'Api_College/registerCollege';
$route['api/getAllColleges']                    = 'Api_College/getAllColleges';
$route['api/deleteCollege']                     = 'Api_College/deleteCollege';
$route['api/deleteSchoolYear']                  = 'Api_Year/deleteSchoolYear';
$route['api/registerSchoolYear']                = 'Api_Year/registerSchoolYear';
$route['api/getAllSchoolYears']                 = 'Api_Year/getAllSchoolYears';
$route['api/getSearchTeacher']                  = 'Api_Teacher/getSearchTeacher';
$route['api/getAllTeachers']                    = 'Api_Teacher/getAllTeachers';
$route['api/editCourse']                        = 'Api_Course/editCourse';
$route['api/getAllCourses']                     = 'Api_Course/getAllCourses';
$route['api/registerCurso']                     = 'Api_Course/registerCurso';
$route['api/getAllCursosFaculdadeAno']          = 'Api_Course/getAllCollegesYearCourses';
$route['api/getAllCursosFaculdade']             = 'Api_Course/getAllCollegesCourses';
$route['api/getAllCadeirasByCourse']            = 'Api_Subject/getAllCadeirasByCourse';
$route["api/getAllCadeirasFaculdade"]           = 'Api_Subject/getAllCadeirasFaculdade';
$route['api/deleteCourse']                      = 'Api_Course/deleteCourse';
$route['api/getSearchStudent']                  = 'Api_Student/getSearchStudent';
$route['api/getSearchStudentNotInSubject']      = 'Api_Student/getSearchStudentNotInSubject';

$route['api/getAllStudents']                    = 'Api_Student/getAllStudents';
// $route['api/getAllSubjectsByCourse']            = 'Api_Subject/getAllSubjectsByCourse';
// $route['api/getAllCoursesByYear']               = 'Api_Course/getAllCoursesByYear';
$route['api/registerSubject']                   = 'Api_Subject/registerSubject';
$route['api/getAllSubjects']                    = 'Api_Subject/getAllSubjects';
$route['api/getSubjectsByFilters']              = 'Api_Subject/getSubjectsByFilters';
$route['api/editSubject']                       = 'Api_Subject/editSubject';
$route['api/deleteSubject']                     = 'Api_Subject/deleteSubject';
$route['api/adminSubject']                      = 'Api_Subject/adminSubject';
$route['api/getStudentsSubjectAdmin']           = 'Api_Subject/getStudentsSubjectAdmin';
$route["api/deleteUserFromSubject"]             = 'Api_Subject/deleteUserFromSubject';
$route["api/addStudentSubject"]                 = 'Api_Subject/addStudentSubject';
$route['api/getAdminHome']                      = 'Api_Admin/getAdminHome';


$route['api/saveCSV']                           = 'Api_Admin/export';
$route['api/importX']                           = 'Api_Admin/importX';
$route['api/exportSpecific']                    = 'Api_Admin/exportSpecific';
$route['api/importStudentsCourse']              = 'Api_Admin/importStudentsCourse';
$route['api/importTeachersSubjects']            = 'Api_Admin/importTeachersSubjects';
$route['api/importUcClasses']                   = 'Api_Admin/importUcClasses';


##chat##

$route['api/getChatHistory']                    = 'Api_Chat/getChatHistory';
$route['api/getChatGroupHistory']               = 'Api_Chat/getChatGroupHistory';
$route['api/getChatLogs']                       = 'Api_Chat/getChatLogs';
$route['api/getSearchTeaStu']                   = 'Api_User/getSearchStudentTeachers';
$route['api/sendMessage']                       = 'Api_Chat/sendMessage';
$route['api/sendMessageGroup']                  = 'Api_Chat/sendMessageGroup';
$route['api/getGroups']                         = 'Api_Chat/getGroups';
$route['api/getLastConvo']                      = 'Api_Chat/getLastConvo';

// $route['app/chat/(:any)/(:num)']                = 'app/chat/$2/$1';

# ROUTER.php
$route['route/subject/(:num)']                  = 'Router/subjectById/$1';

# OTHERS
$route['upload/profilePic']                     = 'UploadsC/uploadProfilePic';
$route['app/profile/edit']                      = 'App/editProfile';


$route['default_controller'] = 'landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

