<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free bootstrap documentation template">
    <title>OpenCAD API 1.0.0</title>
    <!-- using online links -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- using local links -->
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/sidebar-themes.min.css">
    <link rel="stylesheet" href="css/bootstrap-treeview.min.css">
    <link rel="stylesheet" href="css/postman.min.css">

    <link rel="shortcut icon" type="image/png" href="img/favicon.png" /> </head>

<body>
    <div class="page-wrapper toggled light-theme">
        <div class="modal dark-background" id="snippetModal" tabindex="-1" role="dialog" aria-labelledby="documentation-response-modal" style="display: none;">
        <div class="modal-dialog" role="document">
          <div class="modal-header">
            <div class="title">Example Response</div>
            <button type="button" class="close btn-circle" data-dismiss="modal" aria-label="Close">
              <div>
              <span id="closeModal" aria-hidden="true">�</span>
              </div>
            </button>
          </div>
          <div class="modal-content">
            <div class="modal-body" style="width: 540.5px;">
              <pre class="  language-javascript">
                  <code class=" language-javascript"></code>
              </pre>
            </div>
          </div>
        </div>
      </div>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <!-- sidebar-brand  -->
                <div class="sidebar-item sidebar-brand text-white font-weight-bold">API Documentation</div>
                <!-- sidebar-header  -->
                <!-- sidebar-menu  -->
                <div class=" sidebar-item sidebar-menu">
                    <div id="tree"></div>
                </div>
                <!-- sidebar-menu  -->
            </div>
        </nav>
        <!-- page-content  -->
        <main class="page-content">
            <div id="overlay" class="overlay"></div>
            <div class="container-fluid">
                <div class="row d-flex align-items-center p-3 border-bottom">
                    <div class="col-md-1">
                        <a id="toggle-sidebar" class="btn rounded-0 p-3" href="#"> <i class="fas fa-bars"></i> </a>
                    </div>
                    <div class="col-md-9"></div>
                    <div class="col-md-2 text-left">
                    </div>
                </div>
                <div class="row p-lg-4">
                    <article class="main-content col-md-12 pr-lg-9" id="doc-body">
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12">
                                <div class="api-information">
                                    <div class="collection-name">
                                        <p>OpenCAD API 1.0.0</p>
                                    </div>
                                    <div class="collection-description">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="1">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET NCIC Arrests <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests/</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Will return all of the NCIC Arrests when called.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET NCIC Arrests</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="1" data-response-info="response_1">GET NCIC Arrests</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="1"  data-id="response_1">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET NCIC Arrests">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests/</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="2">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET Search NCIC Arrests <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests/1</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Arrests table by ID</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET Search NCIC Arrests</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="2" data-response-info="response_2">GET Search NCIC Arrests</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="2"  data-id="response_2">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET Search NCIC Arrests">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests/1</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="3">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET Search NCIC Arrests By Name <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests/name/test api</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Arrests table by NCIC Name</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET Search NCIC Arrests By Name</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="3" data-response-info="response_3">GET Search NCIC Arrests By Name</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="3"  data-id="response_3">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET Search NCIC Arrests By Name">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests/name/test api</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="4">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="DELETE method" >DELETE</span>
                                            DELETE NCIC Arrest By Id <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests/57</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to delete an NCIC Arrest entry by ID.</p></p>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">DELETE NCIC Arrest By Id</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="4" data-response-info="response_4">DELETE NCIC Arrest By Id</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="4"  data-id="response_4">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="DELETE NCIC Arrest By Id">
                                                <code class="is-highlighted">
DELETE <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests/57</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="5">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="POST method" >POST</span>
                                            POST NCIC Arrests <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to post data to the NCIC Arrest table.</p>
<p>Please note, all data is required. For any optional details you wish not to include anything in, please put &ldquo;NULL&rdquo; instead.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{{OC API KEY}}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">BODY <span class="body-type">formdata</span></div>
                                        <hr>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">nameId</div>
                                                <div class="value col-md-9 col-xs-12">Integer (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">arrestReason</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">arrestFine</div>
                                                <div class="value col-md-9 col-xs-12">Integer (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">issuedDate</div>
                                                <div class="value col-md-9 col-xs-12">String (YYYY-MM-DD) (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">issuedBy</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">POST NCIC Arrests</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="5" data-response-info="response_5">POST NCIC Arrests</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="5"  data-id="response_5">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="POST NCIC Arrests">
                                                <code class="is-highlighted">
POST <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="6">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET NCIC Citations <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/nciccitations</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Will return all of the NCIC Citations when called.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET NCIC Citations</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="6" data-response-info="response_6">GET NCIC Citations</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="6"  data-id="response_6">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET NCIC Citations">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/nciccitations</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="7">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET Search By ID NCIC CItations <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/nciccitations/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Citations table by ID</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET Search By ID NCIC CItations</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="7" data-response-info="response_7">GET Search By ID NCIC CItations</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="7"  data-id="response_7">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET Search By ID NCIC CItations">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/nciccitations/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="8">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET Search By Name NCIC Citations <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/nciccitations/name/{name}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Citations table by NCIC Name</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET Search By Name NCIC Citations</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="8" data-response-info="response_8">GET Search By Name NCIC Citations</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="8"  data-id="response_8">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET Search By Name NCIC Citations">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/nciccitations/name/{name}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="9">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="DELETE method" >DELETE</span>
                                            DELETE NCIC Citation By Id <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/nciccitations/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to delete an NCIC Citations entry by ID.</p></p>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">DELETE NCIC Citation By Id</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="9" data-response-info="response_9">DELETE NCIC Citation By Id</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="9"  data-id="response_9">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="DELETE NCIC Citation By Id">
                                                <code class="is-highlighted">
DELETE <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/nciccitations/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="10">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="POST method" >POST</span>
                                            POST NCIC Citations <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/nciccitations</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to post data to the NCIC Citations table.</p>
<p>Please note, all data is required. For any optional details you wish not to include anything in, please put &ldquo;NULL&rdquo; instead.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{{OC API KEY}}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">BODY <span class="body-type">formdata</span></div>
                                        <hr>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">status</div>
                                                <div class="value col-md-9 col-xs-12">Integer (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">nameId</div>
                                                <div class="value col-md-9 col-xs-12">Integer (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">citationName</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">citationFine</div>
                                                <div class="value col-md-9 col-xs-12">Integer (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">issuedDate</div>
                                                <div class="value col-md-9 col-xs-12">String (YYYY-MM-DD, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">issuedBy</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">POST NCIC Citations</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="10" data-response-info="response_10">POST NCIC Citations</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="10"  data-id="response_10">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="POST NCIC Citations">
                                                <code class="is-highlighted">
POST <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/nciccitations</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="11">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET NCIC Warrants <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarrants</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Will return all of the NCIC Warrants when called.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET NCIC Warrants</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="11" data-response-info="response_11">GET NCIC Warrants</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="11"  data-id="response_11">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET NCIC Warrants">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarrants</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="12">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET Search NCIC Warrants By ID <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarrants/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Warrants table by ID</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET Search NCIC Warrants By ID</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="12" data-response-info="response_12">GET Search NCIC Warrants By ID</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="12"  data-id="response_12">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET Search NCIC Warrants By ID">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarrants/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="13">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET Search NCIC Warrants By Name <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarrants/name/{name}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Warrants table by NCIC Name</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET Search NCIC Warrants By Name</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="13" data-response-info="response_13">GET Search NCIC Warrants By Name</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="13"  data-id="response_13">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET Search NCIC Warrants By Name">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarrants/name/{name}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="14">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="DELETE method" >DELETE</span>
                                            DELETE NCIC Warrants Data <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarrants/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to delete an NCIC Warrants entry by ID.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">PARAMS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12"></div>
                                            <div class="value col-md-9 col-xs-12">None</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">DELETE NCIC Warrants Data</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="14" data-response-info="response_14">DELETE NCIC Warrants Data</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="14"  data-id="response_14">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="DELETE NCIC Warrants Data">
                                                <code class="is-highlighted">
DELETE <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarrants/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="15">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="POST method" >POST</span>
                                            POST NCIC Warrants Data <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarrants</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to post data to the NCIC Warrants table.</p>
<p>Please note, all data is required. For any optional details you wish not to include anything in, please put &ldquo;NULL&rdquo; instead.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{{OC API KEY}}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">BODY <span class="body-type">formdata</span></div>
                                        <hr>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">expirationDate</div>
                                                <div class="value col-md-9 col-xs-12">String (YYYY-MM-DD) (Optional)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">warrantName</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">issuingAgency</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">nameId</div>
                                                <div class="value col-md-9 col-xs-12">Integer (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">issuedDate</div>
                                                <div class="value col-md-9 col-xs-12">String (YYYY-MM-DD) (Optional)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">status</div>
                                                <div class="value col-md-9 col-xs-12">Integer (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">POST NCIC Warrants Data</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="15" data-response-info="response_15">POST NCIC Warrants Data</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="15"  data-id="response_15">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="POST NCIC Warrants Data">
                                                <code class="is-highlighted">
POST <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarrants</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="16">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET NCIC Warnings <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Will return all of the NCIC Warnings when called.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET NCIC Warnings</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="16" data-response-info="response_16">GET NCIC Warnings</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="16"  data-id="response_16">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET NCIC Warnings">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="17">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET NCIC Warnings By ID <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarnings/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Warnings table by ID</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET NCIC Warnings By ID</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="17" data-response-info="response_17">GET NCIC Warnings By ID</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="17"  data-id="response_17">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET NCIC Warnings By ID">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarnings/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="18">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET NCIC Warnings By Name <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarnings/name/{name}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Warnings table by NCIC Name</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET NCIC Warnings By Name</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="18" data-response-info="response_18">GET NCIC Warnings By Name</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="18"  data-id="response_18">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET NCIC Warnings By Name">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarnings/name/{name}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="19">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="DELETE method" >DELETE</span>
                                            DELETE NCIC Warnings By ID <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarnings/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to delete an NCIC Warnings entry by ID.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">DELETE NCIC Warnings By ID</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="19" data-response-info="response_19">DELETE NCIC Warnings By ID</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="19"  data-id="response_19">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="DELETE NCIC Warnings By ID">
                                                <code class="is-highlighted">
DELETE <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarnings/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="20">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="POST method" >POST</span>
                                            POST NCIC Warnings <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarnings</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to post data to the NCIC Warnings table.</p>
<p>Please note, all data is required. For any optional details you wish not to include anything in, please put &ldquo;NULL&rdquo; instead.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{{OC API KEY}}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">BODY <span class="body-type">formdata</span></div>
                                        <hr>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">status</div>
                                                <div class="value col-md-9 col-xs-12">Integer (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">nameId</div>
                                                <div class="value col-md-9 col-xs-12">Integer (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">warningName</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">issuedDate</div>
                                                <div class="value col-md-9 col-xs-12">String (YYYY-MM-DD) (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">issuedBy</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">POST NCIC Warnings</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="20" data-response-info="response_20">POST NCIC Warnings</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="20"  data-id="response_20">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="POST NCIC Warnings">
                                                <code class="is-highlighted">
POST <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicwarnings</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="21">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET NCIC Plates <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicplates</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Will return all of the NCIC Plates when called.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET NCIC Plates</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="21" data-response-info="response_21">GET NCIC Plates</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="21"  data-id="response_21">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET NCIC Plates">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicplates</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="22">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET Search NCIC Plates By ID <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicplates/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Plates table by ID</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET Search NCIC Plates By ID</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="22" data-response-info="response_22">GET Search NCIC Plates By ID</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="22"  data-id="response_22">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET Search NCIC Plates By ID">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicplates/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="23">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET Search NCIC Plates By Name <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicplates/name/{name}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Plates table by NCIC Name</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET Search NCIC Plates By Name</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="23" data-response-info="response_23">GET Search NCIC Plates By Name</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="23"  data-id="response_23">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET Search NCIC Plates By Name">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicplates/name/{name}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="24">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET Search NCIC Plates By Plate <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicplates/search/{plate}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Plates table by Plate</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET Search NCIC Plates By Plate</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="24" data-response-info="response_24">GET Search NCIC Plates By Plate</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="24"  data-id="response_24">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET Search NCIC Plates By Plate">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicplates/search/{plate}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="25">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="DELETE method" >DELETE</span>
                                            DELETE NCIC Plate By Id <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to delete an NCIC Plates entry by ID.</p></p>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">DELETE NCIC Plate By Id</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="25" data-response-info="response_25">DELETE NCIC Plate By Id</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="25"  data-id="response_25">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="DELETE NCIC Plate By Id">
                                                <code class="is-highlighted">
DELETE <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicarrests/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="26">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="POST method" >POST</span>
                                            POST NCIC Plates <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicplates</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to post data to the NCIC Plates table.</p>
<p>Please note, all data is required. For any optional details you wish not to include anything in, please put &ldquo;NULL&rdquo; instead.</p>
<p>Options Only requires you to make the options that are set within the table in the database, failing to match exactly, will result in the field being blank</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{{OC API KEY}}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">BODY <span class="body-type">formdata</span></div>
                                        <hr>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">nameId</div>
                                                <div class="value col-md-9 col-xs-12">Integer (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">vehPlate</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">vehMake</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">vehModel</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">vehPrimaryColor</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">vehInsuranceType</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">flags</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Optional)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">vehRegState</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">notes</div>
                                                <div class="value col-md-9 col-xs-12">String (Optional)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">POST NCIC Plates</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="26" data-response-info="response_26">POST NCIC Plates</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="26"  data-id="response_26">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="POST NCIC Plates">
                                                <code class="is-highlighted">
POST <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicplates</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="27">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET NCIC Names <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicnames</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Will return all of the NCIC Names when called.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET NCIC Names</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="27" data-response-info="response_27">GET NCIC Names</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="27"  data-id="response_27">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET NCIC Names">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicnames</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="28">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET Search NCIC Names By ID <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicnames/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Names table by ID</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET Search NCIC Names By ID</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="28" data-response-info="response_28">GET Search NCIC Names By ID</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="28"  data-id="response_28">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET Search NCIC Names By ID">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicnames/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="29">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET Search  By Name <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicnames/name/{name}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Names table by NCIC Name</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET Search  By Name</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="29" data-response-info="response_29">GET Search  By Name</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="29"  data-id="response_29">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET Search  By Name">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicnames/name/{name}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="30">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="DELETE method" >DELETE</span>
                                            DELETE NCIC  Names By ID <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicnames/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to delete an NCIC Names entry by ID.</p></p>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">DELETE NCIC  Names By ID</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="30" data-response-info="response_30">DELETE NCIC  Names By ID</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="30"  data-id="response_30">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="DELETE NCIC  Names By ID">
                                                <code class="is-highlighted">
DELETE <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicnames/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="31">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="POST method" >POST</span>
                                            POST NCIC  Names <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicnames</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to post data to the NCIC Names table.</p>
<p>Please note, all data is required. For any optional details you wish not to include anything in, please put &ldquo;NULL&rdquo; instead.</p>
<p>Options Only requires you to make the options that are set within the table in the database, failing to match exactly, will result in the field being blank</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{{OC API KEY}}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">BODY <span class="body-type">formdata</span></div>
                                        <hr>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">submittedByName</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">submittedById</div>
                                                <div class="value col-md-9 col-xs-12">Integer (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">name</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">dob</div>
                                                <div class="value col-md-9 col-xs-12">String (YYYY-MM-DD, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">address</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">gender</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">race</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">dlStatus</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">dlType</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">dlClass</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">dlIssuer</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">hairColor</div>
                                                <div class="value col-md-9 col-xs-12">String (Optional)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">build</div>
                                                <div class="value col-md-9 col-xs-12">String (Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">weaponPermitStatus</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">weaponPermitType</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">weaponPermitIssuedBy</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">bloodType</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">organDonor</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">deceased</div>
                                                <div class="value col-md-9 col-xs-12">String (Options Only, Required)</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">POST NCIC  Names</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="31" data-response-info="response_31">POST NCIC  Names</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="31"  data-id="response_31">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="POST NCIC  Names">
                                                <code class="is-highlighted">
POST <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicnames</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="32">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET NCIC Weapons <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicweapons</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Will return all of the NCIC Weapons when called.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET NCIC Weapons</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="32" data-response-info="response_32">GET NCIC Weapons</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="32"  data-id="response_32">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET NCIC Weapons">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicweapons</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="33">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET NCIC Weapons By Name <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicweapons/name/{name}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Weapons table by ID</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET NCIC Weapons By Name</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="33" data-response-info="response_33">GET NCIC Weapons By Name</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="33"  data-id="response_33">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET NCIC Weapons By Name">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicweapons/name/{name}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="34">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="GET method" >GET</span>
                                            GET NCIC Weapons By ID <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicweapons/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to search the NCIC Weapons table by NCIC Name</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">GET NCIC Weapons By ID</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="34" data-response-info="response_34">GET NCIC Weapons By ID</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="34"  data-id="response_34">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="GET NCIC Weapons By ID">
                                                <code class="is-highlighted">
GET <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicweapons/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="35">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="DELETE method" >DELETE</span>
                                            DELETE NCIC Weapons By ID <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicweapons/{id}</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to delete an NCIC Weapons entry by ID.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{key}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">DELETE NCIC Weapons By ID</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="35" data-response-info="response_35">DELETE NCIC Weapons By ID</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="35"  data-id="response_35">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="DELETE NCIC Weapons By ID">
                                                <code class="is-highlighted">
DELETE <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicweapons/{id}</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-no-padding row-eq-height">
                            <div class="col-md-6 col-xs-12 section">
                                <div class="api-information" id="36">
                                     <div class="heading">
                                        <div class="name">
                                            <span class="POST method" >POST</span>
                                            POST NCIC Weapons <span class="lock-icon"></span>
                                        </div>
                                     </div>
                                    <div class="url"><?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicweapons</div>
                                    
                                    <div class="description request-description">
                                        <p><p>Allows you to post data to the NCIC Weapons table.</p>
<p>Please note, all data is required. For any optional details you wish not to include anything in, please put &ldquo;NULL&rdquo; instead.</p></p>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">HEADERS</div>
                                        <hr>
                                          <div class="param row">
                                            <div class="name col-md-3 col-xs-12">oc-apikey</div>
                                            <div class="value col-md-9 col-xs-12">{{OC API KEY}}</div>
                                            <div class="description col-md-9 col-xs-12"><p>None</p>
                                            </div>
                                          </div>
                                    </div>
                                    
                                    <div class="request-body">
                                        <div class="body-heading">BODY <span class="body-type">formdata</span></div>
                                        <hr>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">nameId</div>
                                                <div class="value col-md-9 col-xs-12">11</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">arrestReason</div>
                                                <div class="value col-md-9 col-xs-12">test arrest</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">arrestFine</div>
                                                <div class="value col-md-9 col-xs-12">1000</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">issuedDate</div>
                                                <div class="value col-md-9 col-xs-12">2022-02-05</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                              <div class="param row">
                                                <div class="name col-md-3 col-xs-12">issuedBy</div>
                                                <div class="value col-md-9 col-xs-12">LSPD</div>
                                                <div class="description col-md-9 col-xs-12"><p>None</p>
                                                </div>
                                              </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12 examples">
                                <div class="sample-request">
                                    <div class="heading">
                                        <span>Example Request</span>
                                    </div>
                                    <div class="responses-index">
                                        <div class="dropdown response-name">
                                            <button class="btn   responses-dropdown truncate" type="button" id="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                              <span id="selected" class="response-name-label">POST NCIC Weapons</span>
                                                <span class="caret"></span>

                                            </button>

                                            <ul class="dropdown-menu" aria-labelledby="f678f251-1750-4e3a-b5d8-05b4c6b0fb37_dropdown">
                                                <li class="truncate" data-request-info="36" data-response-info="response_36">POST NCIC Weapons</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="formatted-requests " data-request-id="36"  data-id="response_36">
                                    <div class="request code-snippet">
                                        <div>
                                            <pre class="click-to-expand-wrapper is-snippet-wrapper " data-title="POST NCIC Weapons">
                                                <code class="is-highlighted">
POST <?php echo $_SERVER['HTTP_HOST']; ?>/oc-api/v1/ncic/ncicweapons</code>
                                            </pre>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </article>
                </div>
            </div>
        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    <!-- using online scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/bootstrap-treeview.min.js"></script>
    <script src="js/main.min.js"></script>
    <script type="application/javascript">
        var data = [{'text': 'NCIC', 'nodes': [{'text': 'Arrests', 'nodes': [{'text': 'GET NCIC Arrests', 'href': '#1', 'method': 'GET'}, {'text': 'GET Search NCIC Arrests', 'href': '#2', 'method': 'GET'}, {'text': 'GET Search NCIC Arrests By Name', 'href': '#3', 'method': 'GET'}, {'text': 'DELETE NCIC Arrest By Id', 'href': '#4', 'method': 'DELETE'}, {'text': 'POST NCIC Arrests', 'href': '#5', 'method': 'POST'}], 'icon': 'fas fa-folder', 'selectable': 'false'}, {'text': 'Citations', 'nodes': [{'text': 'GET NCIC Citations', 'href': '#6', 'method': 'GET'}, {'text': 'GET Search By ID NCIC CItations', 'href': '#7', 'method': 'GET'}, {'text': 'GET Search By Name NCIC Citations', 'href': '#8', 'method': 'GET'}, {'text': 'DELETE NCIC Citation By Id', 'href': '#9', 'method': 'DELETE'}, {'text': 'POST NCIC Citations', 'href': '#10', 'method': 'POST'}], 'icon': 'fas fa-folder', 'selectable': 'false'}, {'text': 'Warrants', 'nodes': [{'text': 'GET NCIC Warrants', 'href': '#11', 'method': 'GET'}, {'text': 'GET Search NCIC Warrants By ID', 'href': '#12', 'method': 'GET'}, {'text': 'GET Search NCIC Warrants By Name', 'href': '#13', 'method': 'GET'}, {'text': 'DELETE NCIC Warrants Data', 'href': '#14', 'method': 'DELETE'}, {'text': 'POST NCIC Warrants Data', 'href': '#15', 'method': 'POST'}], 'icon': 'fas fa-folder', 'selectable': 'false'}, {'text': 'Warnings', 'nodes': [{'text': 'GET NCIC Warnings', 'href': '#16', 'method': 'GET'}, {'text': 'GET NCIC Warnings By ID', 'href': '#17', 'method': 'GET'}, {'text': 'GET NCIC Warnings By Name', 'href': '#18', 'method': 'GET'}, {'text': 'DELETE NCIC Warnings By ID', 'href': '#19', 'method': 'DELETE'}, {'text': 'POST NCIC Warnings', 'href': '#20', 'method': 'POST'}], 'icon': 'fas fa-folder', 'selectable': 'false'}, {'text': 'Plates', 'nodes': [{'text': 'GET NCIC Plates', 'href': '#21', 'method': 'GET'}, {'text': 'GET Search NCIC Plates By ID', 'href': '#22', 'method': 'GET'}, {'text': 'GET Search NCIC Plates By Name', 'href': '#23', 'method': 'GET'}, {'text': 'GET Search NCIC Plates By Plate', 'href': '#24', 'method': 'GET'}, {'text': 'DELETE NCIC Plate By Id', 'href': '#25', 'method': 'DELETE'}, {'text': 'POST NCIC Plates', 'href': '#26', 'method': 'POST'}], 'icon': 'fas fa-folder', 'selectable': 'false'}, {'text': 'Names', 'nodes': [{'text': 'GET NCIC Names', 'href': '#27', 'method': 'GET'}, {'text': 'GET Search NCIC Names By ID', 'href': '#28', 'method': 'GET'}, {'text': 'GET Search  By Name', 'href': '#29', 'method': 'GET'}, {'text': 'DELETE NCIC  Names By ID', 'href': '#30', 'method': 'DELETE'}, {'text': 'POST NCIC  Names', 'href': '#31', 'method': 'POST'}], 'icon': 'fas fa-folder', 'selectable': 'false'}, {'text': 'Weapons', 'nodes': [{'text': 'GET NCIC Weapons', 'href': '#32', 'method': 'GET'}, {'text': 'GET NCIC Weapons By Name', 'href': '#33', 'method': 'GET'}, {'text': 'GET NCIC Weapons By ID', 'href': '#34', 'method': 'GET'}, {'text': 'DELETE NCIC Weapons By ID', 'href': '#35', 'method': 'DELETE'}, {'text': 'POST NCIC Weapons', 'href': '#36', 'method': 'POST'}], 'icon': 'fas fa-folder', 'selectable': 'false'}], 'icon': 'fas fa-folder', 'selectable': 'false'}]
        $('#tree').treeview({
            data: data,
            levels: 10,
            expandIcon: 'fas fa-caret-right',
            collapseIcon: 'fas fa-caret-down',
            enableLinks: true,
            showIcon: true,
            showMethod: true
        });
    </script>

</body>

</html>