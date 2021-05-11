<?php

namespace Lostlink\CrowdchanceArk;

use BitWasp\Bitcoin\Mnemonic\MnemonicFactory;
use Lostlink\Ark\Crypto\Configuration\Network;
use Lostlink\Ark\Crypto\Identities\Address;
use Lostlink\Ark\Crypto\Identities\PrivateKey;
use Lostlink\Ark\Crypto\Identities\PublicKey;
use Lostlink\Ark\Crypto\Transactions\Builder\TransferBuilder;
use Lostlink\Ark\Facades\Ark;

class CrowdchanceArk
{
    public string $passphrase;
    public string $private_key;
    public string $public_key;
    public string $address;

    public function __construct($passphrase = null)
    {
        $network = config('crowdchance_ark.network');

        Network::set(new $network);

        $this->passphrase = $passphrase ?? MnemonicFactory::bip39()->create();
    }

    public function make(): self
    {
        return $this
            ->createPrivateKey()
            ->createPublicKey()
            ->createAddress();
    }

    public function createPrivateKey(): self
    {
        $this->private_key = PrivateKey::fromPassphrase($this->passphrase)->getHex();

        return $this;
    }

    public function createPublicKey(): self
    {
        $this->public_key = PublicKey::fromPassphrase($this->passphrase)->getHex();

        return $this;
    }

    public function createAddress(): self
    {
        $this->address = Address::fromPassphrase($this->passphrase);

        return $this;
    }

    public function pushMessage($data): self
    {
        //
        return $this;
    }


    public function pushTransaction($data): self
    {
        Ark::api('Transactions')->create([
            TransferBuilder::new()
                ->recipient('ANBkoGqWeTSiaEVgVzSKZd3jS7UWzv9PSo')
                ->withNonce($this->nextNonce())
                ->amount(1 * 10 ** 8)
                ->vendorField('This is a transaction from PHP')
                ->sign($this->passphrase)
                ->toArray(),
        ]);

        return $this;
    }

    public function nextNonce(): int
    {
        return collect(Ark::api('Wallets')->show('TDGauJXU2itnqFPV6doCd4KWSbL1D69DUx'))
                ->recursive()
                ->get('data')
                ->get('nonce') + 1;
    }

}
