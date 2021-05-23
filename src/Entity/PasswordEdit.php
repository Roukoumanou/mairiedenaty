<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class PasswordEdit
{


    /**
     * Permet de reccevoir l'ancien mot de passe
     *
     * @var mixed
     */
    private $oldPassword;

    /**
     * @var mixed
     * @Assert\Length(
     *      min=8,
     *      minMessage="Le mot de passe doit faire minimum {{ limit }} caractères")
     */
    private $newPassword;

    /**
     * @var mixed
     * @Assert\EqualTo(propertyPath="newPassword", message="Les deux mot de passes ne se ressemblent pas !")
     */
    private $confirmeNewPassword;


    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }

    public function setOldPassword(string $oldPassword): self
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    public function getNewPassword(): ?string
    {
        return $this->newPassword;
    }

    public function setNewPassword(string $newPassword): self
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getConfirmeNewPassword(): ?string
    {
        return $this->confirmeNewPassword;
    }

    public function setConfirmeNewPassword(string $confirmeNewPassword): self
    {
        $this->confirmeNewPassword = $confirmeNewPassword;

        return $this;
    }
}
