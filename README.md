# Slack Exception Logger

Add this to your report method in `app\Exceptions\Handler.php`

```php
public function report(Exception $exception)
{
    if ($this->shouldReport($exception)){
        (new SlackExceptionLogger())->log(YOUR_SLACK_WEBHOOK, $exception);
    }
    
    parent::report($exception);
}
```
