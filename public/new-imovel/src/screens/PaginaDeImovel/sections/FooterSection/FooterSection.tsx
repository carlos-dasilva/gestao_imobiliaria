import { HeartIcon, MailIcon, PhoneIcon } from "lucide-react";
import React from "react";
import { Separator } from "../../../../components/ui/separator";

const navigationLinks = [
  { label: "Home" },
  { label: "Imóveis" },
  { label: "Contato" },
  { label: "Conteudo" },
  { label: "Quem Somos" },
  { label: "Como Funciona" },
];

const institutionalLinks = [
  { label: "Quem Somos" },
  { label: "Política de Privacidade" },
  { label: "Termos de Uso" },
];

const contactInfo = [
  {
    icon: PhoneIcon,
    text: "(51) 99453-1889",
  },
  {
    icon: "https://c.animaapp.com/mht9bn8iNrOJ7D/img/vector-10.svg",
    text: "CRECI: 81903",
  },
  {
    icon: MailIcon,
    text: "catiaalexandracorretora@gmail.com",
  },
];

const socialMediaIcons = [
  {
    src: "https://c.animaapp.com/mht9bn8iNrOJ7D/img/vector-5.svg",
    alt: "Facebook",
  },
  {
    src: "https://c.animaapp.com/mht9bn8iNrOJ7D/img/vector-2.svg",
    alt: "LinkedIn",
  },
  {
    src: "https://c.animaapp.com/mht9bn8iNrOJ7D/img/vector-6.svg",
    alt: "Instagram",
  },
];

export const FooterSection = (): JSX.Element => {
  return (
    <footer className="relative w-full bg-[linear-gradient(90deg,rgba(164,0,0,1)_0%,rgba(110,0,0,1)_74%,rgba(62,0,0,1)_100%)] py-12 px-[30px]">
      <div className="max-w-[1440px] mx-auto">
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12">
          <div className="lg:col-span-1 flex items-start">
            <img
              className="w-[282px] h-[141px]"
              alt="Logo"
              src="/img/logo.svg"
              onError={(e) => { (e.currentTarget as HTMLImageElement).style.display = 'none'; }}
            />
          </div>

          <nav className="flex flex-col gap-3">
            <h3 className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-[22px] tracking-[0] leading-[22.0px] mb-1">
              NAVEGAÇÃO
            </h3>
            <ul className="flex flex-col gap-2.5">
              {navigationLinks.map((link, index) => (
                <li key={index} className="flex items-center gap-[5px]">
                  <div className="w-[5px] h-[5px] bg-white rounded-[2.5px] flex-shrink-0" />
                  <a
                    href="#"
                    className="[font-family:'Roboto',Helvetica] font-normal text-white text-lg tracking-[0] leading-[18.0px] hover:underline transition-colors"
                  >
                    {link.label}
                  </a>
                </li>
              ))}
            </ul>
          </nav>

          <div className="flex flex-col gap-2.5">
            <h3 className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-[22px] tracking-[0] leading-[22.0px] mb-1">
              ATENDIMENTO
            </h3>
            <div className="flex flex-col gap-2.5">
              {contactInfo.map((item, index) => (
                <div key={index} className="flex items-center gap-2.5">
                  {typeof item.icon === "string" ? (
                    <img
                      className="w-[17px] h-[17px] flex-shrink-0"
                      alt="Icon"
                      src={item.icon}
                    />
                  ) : (
                    <item.icon className="w-[17px] h-[17px] flex-shrink-0 text-white" />
                  )}
                  <span className="[font-family:'Roboto',Helvetica] font-normal text-white text-lg tracking-[0] leading-[18.0px]">
                    {item.text}
                  </span>
                </div>
              ))}
            </div>
          </div>

          <div className="flex flex-col gap-[15px]">
            <h3 className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-[22px] tracking-[0] leading-[22.0px]">
              REDES SOCIAS
            </h3>
            <div className="flex items-center gap-2.5">
              {socialMediaIcons.map((icon, index) => (
                <a
                  key={index}
                  href="#"
                  className="hover:opacity-80 transition-opacity"
                >
                  <img
                    className="w-[30px] h-[30px]"
                    alt={icon.alt}
                    src={icon.src}
                  />
                </a>
              ))}
            </div>
          </div>

          <nav className="flex flex-col gap-3">
            <h3 className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-[22px] tracking-[0] leading-[22.0px] mb-1">
              INSTITUCIONAL
            </h3>
            <ul className="flex flex-col gap-2.5">
              {institutionalLinks.map((link, index) => (
                <li key={index} className="flex items-center gap-[5px]">
                  <div className="w-[5px] h-[5px] bg-white rounded-[2.5px] flex-shrink-0" />
                  <a
                    href="#"
                    className="[font-family:'Roboto',Helvetica] font-normal text-white text-lg tracking-[0] leading-[18.0px] hover:underline transition-colors"
                  >
                    {link.label}
                  </a>
                </li>
              ))}
            </ul>
          </nav>
        </div>

        <Separator className="bg-white/20 mb-4" />

        <div className="flex flex-col md:flex-row justify-between items-center gap-4">
          <div className="flex items-center gap-2">
            <HeartIcon className="w-[19px] h-[19px] text-white fill-white" />
            <p className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-sm tracking-[0] leading-[14.0px]">
              2025 CÁTIA ALEXANDRA CORRETORA. TODOS OS DIREITOS RESERVADOS.
            </p>
          </div>
          <p className="[font-family:'Archivo_Narrow',Helvetica] font-semibold italic text-white text-sm tracking-[0] leading-[14.0px]">
            FEITO COM AMOR PARA FACILITAR SUA BUSCA.
          </p>
        </div>
      </div>
    </footer>
  );
};
