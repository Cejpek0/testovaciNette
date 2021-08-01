<?php declare(strict_types = 1);

namespace App\Model\Database\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\ImageRepository")
 * @ORM\Table(name="`user`")
 * @ORM\HasLifecycleCallbacks
 */
class ImageEntity extends AbstractEntity
{
    /**
     * @var ORM\Id
     * @ORM\Column(type="id",unique=TRUE,nullable=FALSE)
     */
    private ORM\Id $id;

    /**
     * @var string
     * @ORM\Column(type="string",length=255, nullable=FALSE, unique=FALSE)
     */
    private string $name;

    /**
     * @var string
     * @ORM\Column(type="string",length=255, nullable=FALSE, unique=TRUE)
     */
    private string $file_name;

    /**
     * @var string
     * @ORM\Column(type="string",length=50, nullable=FALSE, unique=FALSE)
     */
    private string $type;

    /**
     * @var bool
     * @ORM\Column(type="boolean", nullable=FALSE, unique=FALSE, )
     */
    private bool $do_show;

    public function __construct(string $name, string $file_name, string $type, bool $do_show)
    {
        $this->name = $name;
        $this->file_name = $file_name;
        $this->type = $type;
        $this->do_show = $do_show;
    }

    /**
     * @ORM\GeneratedValue
     * @return ORM\Id
     */
    public function getId(): ORM\Id
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->file_name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return bool
     */
    public function isDoShow(): bool
    {
        return $this->do_show;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param bool $do_show
     */
    public function setDoShow(bool $do_show): void
    {
        $this->do_show = $do_show;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}