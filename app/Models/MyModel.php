namespace App\Models;
use App\Libraries\DatabaseLogger;
use Illuminate\Database\Eloquent\Model;

class MyModel extends Model
{
    protected $connection = 'database_logger'; // Usa la conexión personalizada

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setConnection(DatabaseLogger::class); // Establece la conexión personalizada
    }
}
