import React from "react";
import { ContactSection } from "./sections/ContactSection";
import { FAQsSection } from "./sections/FAQsSection";
import { FooterSection } from "./sections/FooterSection";
import { HomeSection } from "./sections/HomeSection";
import { HowToFindPropertySection } from "./sections/HowToFindPropertySection";
import { IntroductionSection } from "./sections/IntroductionSection";
import { JourneySection } from "./sections/JourneySection";
import { PartnershipsSection } from "./sections/PartnershipsSection";
import { PropertiesListSection } from "./sections/PropertiesListSection";
import { PropertiesSection } from "./sections/PropertiesSection";
import { PropertyAreasSection } from "./sections/PropertyAreasSection";
import { ServicesSection } from "./sections/ServicesSection";
import { TestimonialsSection } from "./sections/TestimonialsSection";

export const SiteCompleto = (): JSX.Element => {
  return (
    <div
      className="overflow-hidden w-full min-w-[1440px] relative"
      data-model-id="3:120"
    >
      <section className="relative w-full opacity-0 translate-y-[-1rem] animate-fade-in [--animation-delay:0ms]">
        <HomeSection />
      </section>

      <section className="relative w-full opacity-0 translate-y-[-1rem] animate-fade-in [--animation-delay:200ms]">
        <PropertiesSection />
      </section>

      <section className="relative w-full bg-[#fff8ef] py-16 px-4 md:px-8 lg:px-16 overflow-hidden">
        <div className="max-w-[1440px] mx-auto relative">
          <div className="flex gap-8 items-start">
            {/* Photo Section - Left Side */}
            <div className="relative flex-shrink-0 w-[453px] opacity-0 translate-y-[-1rem] animate-fade-in [--animation-delay:200ms]">
              <div className="absolute top-0 left-0 w-full h-[986px] [background:radial-gradient(50%_50%_at_50%_45%,rgba(188,4,4,1)_0%,rgba(110,16,16,1)_100%)]" />
              <img
                className="relative w-full h-[1114px] object-cover"
                alt="Cátia Alexandra"
                src="https://c.animaapp.com/mht8rhtrvso9Rd/img/imagem-do-whatsapp-de-2025-09-16---s--10-10-27-5da84767.png"
              />
            </div>

            {/* Content Section - Right Side */}
            <div className="flex-1 flex flex-col gap-8">
              {/* Top Row: Introduction */}
              <div className="opacity-0 translate-y-[-1rem] animate-fade-in [--animation-delay:400ms]">
                <IntroductionSection />
              </div>

              {/* Second Row: Journey and Services */}
              <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-[30px]">
                <div className="opacity-0 translate-y-[-1rem] animate-fade-in [--animation-delay:600ms]">
                  <JourneySection />
                </div>

                <div className="opacity-0 translate-y-[-1rem] animate-fade-in [--animation-delay:800ms]">
                  <ServicesSection />
                </div>
              </div>

              {/* Third Row: Properties List and Property Areas */}
              <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-[30px]">
                <div className="opacity-0 translate-y-[-1rem] animate-fade-in [--animation-delay:1000ms]">
                  <PropertiesListSection />
                </div>

                <div className="opacity-0 translate-y-[-1rem] animate-fade-in [--animation-delay:1200ms]">
                  <PropertyAreasSection />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section className="relative w-full">
        <HowToFindPropertySection />
      </section>

      <section className="relative w-full">
        <PartnershipsSection />
      </section>

      <section className="relative w-full">
        <ContactSection />
      </section>

      <section className="relative w-full">
        <TestimonialsSection />
      </section>

      <section className="relative w-full">
        <FAQsSection />
      </section>

      <section className="relative w-full">
        <FooterSection />
      </section>

    </div>
  );
};
