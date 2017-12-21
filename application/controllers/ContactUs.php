<?php
  /**
   *
   */
  class ContactUs extends CI_Controller
  {

    function __construct()
    {
      parent::__construct();

      $this->load->helper('url');
      $this->load->helper('file');
      $this->load->helper('form');
      $this->load->library('email');

      $this->load->library('session');

      //load models

      $this->load->model('ContactUsModel');
      $this->load->model('CartManagementModel');
    }

    public function index()
    {

      $uniqueId = $this->session->userdata('uniqueSessionId');

      $data['cartDetails'] = $this->CartManagementModel->grabCartDetails($uniqueId);

      $this->load->view('content/theme/cssBoilerPlate.php');
      $this->load->view('content/theme/header.php',$data);
      $this->load->view('content/ContactUs/index.php');
      $this->load->view('content/theme/footer.php');

      
    }

    public function submitComments()
    {

      $config['protocol'] = 'sendmail';
      $config['mailpath'] = '/usr/sbin/sendmail';
      $config['charset'] = 'iso-8859-1';
      $config['wordwrap'] = TRUE;

      $this->email->initialize($config);


      $name = $this->input->post('name');
      $email = $this->input->post('email');
      $comments = $this->input->post('comments');

      $data = array('Name'=>$name, 'Email'=>$email, 'Comments'=>$comments, 'CommentDate'=>date('Y-m-d'));

      $this->ContactUsModel->insertCommentLog($data);

      $text = '<style type="text/css">
            body,
            html,
            .body {
              background: #f3f3f3 !important;
            }
          </style>

          <container>

            <spacer size="16"></spacer>

            <row>
              <columns>
                <h1>Customer Service Ticket</h1>
                <p>'. date('Y-m-d'). '</p>

                <spacer size="16"></spacer>

                <callout class="secondary">
                  <row>
                    <columns large="6">
                      <p>
                        <strong>Submitted By </strong>'. $name .'
                      </p>
                      <p>
                        <strong>Email Address </strong> '.
                        $email. '
                      </p>

                      <p>
                        <strong>Comment</strong>
                         ' . $comments . '
                      </p>

                  </row>
                </callout>

              </columns>
            </row>
            <row class="footer text-center">
              <columns large="3">
                <img src="http://www.naijafoodies.com" alt="Naija Foodies">
              </columns>
              <columns large="3">
                <p>
                  Call us at 317-998-7587<br/>

                </p>
              </columns>
              <columns large="3">
                <p>
                  2442 Central Ave,<br/>
                  Indianapolis, IN 46205
                </p>
              </columns>
            </row>
          </container>';

          $this->email->from($email, $name);
          $this->email->to('naijafoodies@gmail.com');
          $this->email->set_mailtype("html");
          $this->email->cc('olusegunakinyelure@gmail.com');
          $this->email->bcc('ugo_njoku@ymail.com');

          $this->email->subject('Customer Service Ticket');
          $this->email->message($text);

          $this->email->send();

    }
  }





 ?>
