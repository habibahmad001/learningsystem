<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class EmailTemplate extends Model
{
    protected $table = 'emailtemplates';

  

    public static function getRecordWithSlug($slug)
    {
        return EmailTemplate::where('slug', '=', $slug)->first();
    }

    /**
     * Common email function to send emails
     * @param  [type] $template [key of the template]
     * @param  [type] $data     [data to be passed to view]
     * @return [type]           [description]
     */
    public function sendEmail($template, $data)
    {

        try{
            $template = EmailTemplate::where('title', '=', $template)->first();
            $content = \Blade::compileString($this->getTemplate($template));

            if(isset($data["email"]) || isset($data["to_email"])) {
                $unsub_email=isset($data["email"])?$data["email"]:$data["to_email"];
                $data["unsubscribe"]    =   url("/unsubscribe?email=" . strtr(base64_encode($unsub_email), '+/=', '._-'));
            }

            $result = $this->render($content, $data);

		\Mail::send(getTheme().'::emails.template', ['body' => $result], function ($message) use ($template, $data)
        {
            $append_sub="";
            if(isset($data['send_to']) && $data['send_to']=='admin'){
                if(!isset($data['name'])) {
                    $name=$template->from_name;
                }else{
                    $name=$data['name'];
                }
                //$message->from($data['to_email'],$name);
                $message->from($template->from_email,$name);

                if(isset($data['slug'])){
                    $append_sub=" - ".$data['slug'];
                }
                if(isset($data['orderid'])){
                    $append_sub=" #".$data['orderid'];
                }

                $message->to($template->from_email)->subject($template->subject.$append_sub);

            }else{
                if(isset($data['orderid'])){
                    $append_sub=" #".$data['orderid'];
                }
                $message->from($template->from_email, $template->from_name);
                $message->to($data['to_email'])->subject($template->subject.$append_sub);
            }

		});

        }  catch (Exception $e) {
             dd($e->getMessage());
        }

    }



	/**
     * Common email function to send emails
     * @param  [type] $template [key of the template]
     * @param  [type] $data     [data to be passed to view]
     * @return [type]           [description]
     */
    public function sendEmailNotification($template, $data)
    {	
    	$template = EmailTemplate::where('title', '=', $template)->first();
    	// dd($template);
    	$content  = \Blade::compileString($this->getTemplate($template));
		$result   = $this->render($content, $data);
		
		return $result;
	}

	/**
	 * Returns the template html code by forming header, body and footer
	 * @param  [type] $template [description]
	 * @return [type]           [description]
	 */
	public function getTemplate($template)
	{
		$header = EmailTemplate::where('title', '=', 'header')->first();
    	$footer = EmailTemplate::where('title', '=', 'footer')->first();

        $view = \View::make(getTheme().'::emails.template', [
    											'header' => $header->content, 
    											'footer' => $footer->content,
    											'body'  => $template->content, 
    											]);

		return $view->render();
	}

	/**
	 * Prepares the view from string passed along with data
	 * @param  [type] $__php  [description]
	 * @param  [type] $__data [description]
	 * @return [type]         [description]
	 */
    public function render($__php, $__data)
	{
	    $obLevel = ob_get_level();
	    ob_start();
	    extract($__data, EXTR_SKIP);
	    try {
	        eval('?' . '>' . $__php);
	    } catch (Exception $e) {
	        while (ob_get_level() > $obLevel) ob_end_clean();
	        throw $e;
	    } catch (Throwable $e) {
	        while (ob_get_level() > $obLevel) ob_end_clean();
            //throw $e;
            throw new FatalThrowableError($e);
	    }
	    return ob_get_clean();
	}

}
